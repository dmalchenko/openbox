<?php

namespace app\controllers;

use app\models\User;
use app\modules\freekassa\models\Freekassa;
use app\modules\opencase\models\CaseType;
use app\modules\opencase\models\Items;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller {

	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['logout'],
				'rules' => [
					[
						'actions' => ['logout'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
			'eauth' => [
				// required to disable csrf validation on OpenID requests
				'class' => \nodge\eauth\openid\ControllerBehavior::className(),
				'only' => ['login'],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function actions() {
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex() {
		$this->layout = 'clear';

		/**
		 * @var $items100 Items[]
		 * @var $items250 Items[]
		 * @var $items500 Items[]
		 * @var $items1000 Items[]
		 */
		$items100 = Items::find()->where(['case_type' => CaseType::CASE_TYPE100])->all();
		$items250 = Items::find()->where(['case_type' => CaseType::CASE_TYPE250])->all();
		$items500 = Items::find()->where(['case_type' => CaseType::CASE_TYPE500])->all();
		$items1000 = Items::find()->where(['case_type' => CaseType::CASE_TYPE1000])->all();

		return $this->render('index', [
			'case100' => $items100,
			'case250' => $items250,
			'case500' => $items500,
			'case1000' => $items1000,
		]) ;
	}

	/**
	 * Login action
	 *
	 * @return Response|string
	 */
	public function actionLogin() {
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		}
		return $this->render('login', [
			'model' => $model,
		]);
	}

	/**
	 * Login action.
	 *
	 * @return Response|string
	 */
	public function actionLoginSocial() {
		$serviceName = Yii::$app->getRequest()->getQueryParam('service');
		if (isset($serviceName)) {
			/** @var $eauth \nodge\eauth\ServiceBase */
			$eauth = Yii::$app->get('eauth')->getIdentity($serviceName);
			$eauth->setRedirectUrl(Yii::$app->getUser()->getReturnUrl());
			$eauth->setCancelUrl(Yii::$app->getUrlManager()->createAbsoluteUrl('site/login'));

			try {
				if ($eauth->authenticate()) {
//					var_dump($eauth->getIsAuthenticated(), $eauth->getAttributes()); exit;

					$identity = User::findByEAuth($eauth);
					Yii::$app->getUser()->login($identity);

					// special redirect with closing popup window
					$eauth->redirect();
				} else {
					// close popup window and redirect to cancelUrl
					$eauth->cancel();
				}
			} catch (\nodge\eauth\ErrorException $e) {
				// save error to show it later
				Yii::$app->getSession()->setFlash('error', 'EAuthException: ' . $e->getMessage());

				// close popup window and redirect to cancelUrl
//				$eauth->cancel();
				$eauth->redirect($eauth->getCancelUrl());
			}
		}
	}

	/**
	 * Logout action.
	 *
	 * @return Response
	 */
	public function actionLogout() {
		Yii::$app->user->logout();

		return $this->goHome();
	}

	/**
	 * Displays contact page.
	 *
	 * @return Response|string
	 */
	public function actionContact() {

		$r = Yii::$app->user->identity;
//		$t = User::addMoney($r->getId(), 100);
		VarDumper::dump($r);
		exit;

	}

	/**
	 * Displays about page.
	 *
	 * @return string
	 */
	public function actionAbout() {
		return $this->render('about');
	}

	/**
	 * @return string
	 */
	public function actionHelp() {
		$this->layout = 'clear';
		return $this->render('help');
	}

	/**
	 * @return string
	 */
	public function actionDelivery() {
		$this->layout = 'clear';
		return $this->render('delivery');
	}

	/**
	 * @return string
	 */
	public function actionTestimonials() {
		$this->layout = 'clear';
		return $this->render('testimonials');
	}

	/**
	 * @return string
	 */
	public function actionShop() {
		$this->layout = 'clear';
		return $this->render('shop');
	}

	/**
	 * @return string
	 */
	public function actionProfile() {
		$this->layout = 'clear';
		return $this->render('profile');
	}

	/**
	 * @return string
	 */
	public function actionProfileProducts() {
		$this->layout = 'clear';
		return $this->render('profile-products');
	}

	/**
	 * @return string
	 */
	public function actionProfileTable() {
		$this->layout = 'clear';
		return $this->render('profile-table');
	}

	/**
	 * @param $id
	 * @return string
	 */
	public function actionBox($id) {
		$this->layout = 'clear';
		$boxes = [
			1 => CaseType::CASE_TYPE100,
			2 => CaseType::CASE_TYPE250,
			3 => CaseType::CASE_TYPE500,
			4 => CaseType::CASE_TYPE1000,
		];

		$case = Items::find()->where(['case_type' => $boxes[$id]])->all();

		return $this->render('box', [
			'box' => $case,
			'id' => $id,
			'type' => $boxes[$id],
		]);
	}
}
