<?php

namespace app\controllers;

use app\models\User;
use app\modules\freekassa\models\Freekassa;
use app\modules\opencase\models\Basket;
use app\modules\opencase\models\CaseType;
use app\modules\opencase\models\Delivery;
use app\modules\opencase\models\DeliveryAddress;
use app\modules\opencase\models\GameLog;
use app\modules\opencase\models\Items;
use app\modules\opencase\models\Promo;
use Yii;
use yii\data\ActiveDataProvider;
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
//					'logout' => ['post'],
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
		]);
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

		$user = User::getCurrentUser();
		if (!$user) {
			$this->redirect(['index']);
		}

		$address = DeliveryAddress::findOne(['token_index' => $user->token_index]);
		if ($address) {
			if ($address->load(Yii::$app->request->post())) {
				$address->update();
				return $this->goHome();
			}
		} else {
			$address = new DeliveryAddress();
			if ($address->load(Yii::$app->request->post())) {
				$address->token_index = $user->token_index;
				$address->save();
				return $this->goHome();
			}
		}

		$r = GameLog::find()
			->select(['SUM(cost_real) as sum', 'COUNT(id) as cnt'])
			->where(['token_index' => $user->token_index])
			->groupBy('token_index')
			->asArray()
			->all();

		$cntBox = $r[0]['cnt'];
		$cntSum = $r[0]['sum'];

		$partnerSet = Promo::find()
			->where(['token_index' => $user->token_index])
			->exists();

		return $this->render('profile', [
			'user' => $user,
			'cntBox' => $cntBox,
			'cntSum' => $cntSum,
			'address' => $address,
			'partnerSet' => $partnerSet,
			'code' => $user->token_index
		]);
	}

	/**
	 * @return string
	 */
	public function actionProfileProducts() {
		$this->layout = 'clear';
		$user = User::getCurrentUser();
		if (!$user) {
			$this->redirect(['index']);
		}

		$basketDataProvider = Basket::find()
			->where(['token_index' => $user->token_index])
			->all();

		return $this->render('profile-products', [
			'basketDataProvider' => $basketDataProvider,
		]);
	}

	/**
	 * @return string
	 */
	public function actionProfileTable() {
		$this->layout = 'clear';
		$user = User::getCurrentUser();
		if (!$user) {
			$this->redirect(['index']);
		}

		$items = Delivery::find()
			->where(['token_index' => $user->token_index])
			->orderBy('updated_at')
			->all();

		return $this->render('profile-table', [
			'items' => $items
		]);
	}

	/**
	 * @return string
	 */
	public function actionProfilePartner() {
		$this->layout = 'clear';
		$user = User::getCurrentUser();
		if (!$user) {
			$this->redirect(['index']);
		}
		$partnerSet = Promo::find()
			->where(['token_index' => $user->token_index])
			->exists();

		return $this->render('profile-partner', [
			'code' => $user->token_index,
			'partnerSet' => $partnerSet,
		]);
	}

	public function actionPromo($code) {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$user = User::getCurrentUser();
		if (!$user) {
			return ['code' => 500, 'msg' => 'Вы не авторизованы'];
		}
		$promo = Promo::findOne(['token_index' => $user->token_index]);
		if ($promo) {
			return ['code' => 500, 'msg' => 'Вы уже ввели промо-код, обновите страницу'];
		}

		$parentUser = User::findOne(['token_index' => $code]);
		if (!$parentUser) {
			return ['code' => 500, 'msg' => 'Такого промо кода не существует'];
		}

		if ($parentUser->token_index == $user->token_index) {
			return ['code' => 500, 'msg' => 'Нельзя вводить свой промо-код'];
		}

		$promo = new Promo();
		$promo->token_index = $user->token_index;
		$promo->token = $user->token;
		$promo->parent_index = $parentUser->token_index;
		$promo->save();

		$user->money += Promo::BONUS_MONEY;
		$user->save();
		return ['code' => 200, 'msg' => ''];

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

	/**
	 * @param $id
	 * @param $bid
	 * @return array
	 */
	public function actionSell($id, $bid) {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$item = Items::findOne($id);
		$user = User::getCurrentUser();
		$basket = Basket::find()
			->where(['token_index' => $user->token_index])
			->andWhere(['id' => $bid])
			->one();

		if (!$user || !$item || !$basket) {
			return ['code' => 500, 'msg' => 'Внутренняя ошибка'];
		}

		if ($basket->item_id != $id) {
			return ['code' => 500, 'msg' => 'Ошибка в запросе'];
		}

		$user->money += $item->cost_sell;
		$user->save();

		$basket->delete();
		return ['code' => 200, 'msg' => 'ok'];
	}
}
