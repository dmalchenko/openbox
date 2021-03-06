<?php

namespace app\controllers;

use app\models\User;
use app\modules\freekassa\models\Freekassa;
use app\modules\opencase\models\Basket;
use app\modules\opencase\models\CaseItem;
use app\modules\opencase\models\CaseType;
use app\modules\opencase\models\Delivery;
use app\modules\opencase\models\DeliveryAddress;
use app\modules\opencase\models\FreeCase;
use app\modules\opencase\models\FreeCaseParam;
use app\modules\opencase\models\GameLog;
use app\modules\opencase\models\Items;
use app\modules\opencase\models\Promo;
use app\modules\opencase\models\PromoCodes;
use app\modules\opencase\models\PromoLog;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller {

    public $enableCsrfValidation = false;

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
    public function actionAdministrator() {
        $this->layout = 'adm';

        $t = Yii::$app->request->get('id');
        if (!$t) {
            return $this->redirect(['administrator', 'id' => 'wins']);
        }
        if ($t == 'success') {
            $a = Yii::$app->request->post('user');
            $b = isset($a['id'], $a['chance']) && $a['id'] && $a['chance'];
            if (!$b) {
                return $this->redirect(['administrator', 'id' => 'danger']);
            }
        }

        return $this->render('administrator', [
            't' => $t
        ]);
    }

    public function actionAgreement() {
        $this->layout = 'clear';
        return $this->render('agreement');
    }

    public function actionIndex() {
        $this->layout = 'clear';

        $items = CaseItem::find()->with('item')->all();
        $items = ArrayHelper::index($items, null, 'case_type');

        $games = GameLog::find()
            ->select('COUNT(id) as cnt, case_type')
            ->groupBy('case_type')
            ->asArray()
            ->all();

        $games = ArrayHelper::index($games, null, 'case_type');

        $user = User::getCurrentUser();

        return $this->render('index', [
            'items' => $items,
            'cnt' => $games,
            'user' => $user,
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

                    if ($code = Yii::$app->session->get('promocode')) {
                        $this->_promoLink($code);
                    }

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

        $id  = Yii::$app->getUser()->getIdentity()->getId();
        $user = User::findOne(['token_index' => crc32($id)]);



        echo '<pre>';
        var_dump($user->attributes);
        echo '</pre>';
        exit;
        return '';
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
            return $this->redirect(['index']);
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

        $cntBox = isset($r[0]['cnt']) ? $r[0]['cnt'] : 0;
        $cntSum = isset($r[0]['sum']) ? $r[0]['sum'] : 0;

        $partnerSet = PromoLog::find()
            ->where(['token' => $user->token_index])
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
            return $this->redirect(['index']);
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
            return $this->redirect(['index']);
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
            return $this->redirect(['index']);
        }

        $promos = PromoLog::find()
            ->where(['token' => $user->token_index])
            ->all();

        $partnerSet = PromoLog::find()
            ->where(['token' => $user->token_index])
            ->exists();

        return $this->render('profile-partner', [
            'code' => $user->token_index,
            'promos' => $promos,
            'partnerSet' => $partnerSet
        ]);
    }

    public function actionPromo($code) {
        $user = User::getCurrentUser();
        if (!$user) {
            echo json_encode(['code' => 500, 'msg' => 'Вы не авторизованы']);
            exit;
        }

        $promo = PromoCodes::findOne(['promocode' => $code]);
        if ($promo) {
            echo json_encode($this->_promoPartner($user, $promo));
            exit;
        } else {
            echo json_encode($this->_promoUser($user, $code));
            exit;
        }
    }

    /**
     * @param User $user
     * @param PromoCodes $promo
     * @return array
     */
    private function _promoPartner(User $user, PromoCodes $promo) {
        $promoLog = PromoLog::findOne(['token' => $user->token_index, 'promocode' => $promo->promocode]);
        if ($promoLog) {
            return ['code' => 500, 'msg' => 'Вы уже ввели промо-код, обновите страницу'];
        }
        $promoLog = new PromoLog();
        $promoLog->promocode = $promo->promocode;
        $promoLog->bonus = $promo->bonus;
        $promoLog->token = $user->token_index;
        $promoLog->save();

        $promo->count++;
        $promo->save();

        $user->money += $promo->bonus;
        $user->save();
        return ['code' => 200, 'msg' => ''];
    }

    /**
     * @param User $user
     * @param string $code
     * @return array
     */
    private function _promoUser(User $user, $code) {
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

        $promoLog = new PromoLog();
        $promoLog->promocode = strval($parentUser->token_index);
        $promoLog->bonus = Promo::BONUS_MONEY;
        $promoLog->token = $user->token_index;
        $promoLog->token_gived = $parentUser->token_index;
        $promoLog->save();

        $user->money += Promo::BONUS_MONEY;
        $user->save();
        return ['code' => 200, 'msg' => ''];
    }

    /**
     * @param $code
     * @return array|bool
     */
    private function _promoLink($code) {
        $user = User::getCurrentUser();

        $promo = PromoLog::findOne(['token' => $user->token_index]);
        if ($promo) {
            return false;
        }

        $parentUser = User::findOne(['token_index' => $code]);
        if (!$parentUser) {
            return false;
        }

        if ($parentUser->token_index == $user->token_index) {
            return false;
        }

        $promo = new Promo();
        $promo->token_index = $user->token_index;
        $promo->token = $user->token;
        $promo->parent_index = $parentUser->token_index;
        $promo->save();

        $promoLog = new PromoLog();
        $promoLog->promocode = strval($parentUser->token_index);
        $promoLog->bonus = Promo::BONUS_MONEY;
        $promoLog->token = $user->token_index;
        $promoLog->token_gived = $parentUser->token_index;
        $promoLog->save();

        $user->money += Promo::BONUS_MONEY;
        $user->save();

        Yii::$app->session->set('promocode', '');
        Yii::$app->session->set('promocode_ok', 'ok');
        return true;
    }

    /**
     * @param $code
     */
    public function actionPartner($code) {
        $user = User::getCurrentUser();
        if ($user) {
            $this->redirect('index');
        }

        $parentUser = User::findOne(['token_index' => $code]);
        if (!$parentUser) {
            $this->redirect('index');
        }

        Yii::$app->session->set('promocode', $code);

        $this->redirect('index');
    }

    /**
     * @param $id
     * @return string
     */
    public function actionBox($id) {
        $this->layout = 'clear';
        $user = User::getCurrentUser();

        $caseNumber = CaseType::find()->where(['type' => $id])->one()->id;

        $case = CaseItem::find()->where(['case_type' => $id])->all();

        $url = '';
        $checkPay = -1;
        $lastOpen = false;
        if ($id == 0) {
            $url = FreeCaseParam::findOne(1)->link;
            if ($user && isset($user->token_index)) {
                $lastOpen = FreeCase::findOne(['token' => $user->token_index]);
                if ($lastOpen) {
                    $lastOpen = $lastOpen->last_open;
                }

                $checkPay = Freekassa::find()
                    ->where(['user_id' => $user->token_index])
                    ->andWhere(['status' => 2])
                    ->andWhere(['>=', 'amount', 99])
                    ->andWhere(new Expression('updated_at >= (UNIX_TIMESTAMP() - 600)'))
                    ->orderBy(['id' => SORT_DESC])
                    ->exists();
            }
        }

        return $this->render('box', [
            'case' => $case,
            'id' => $caseNumber,
            'type' => $id,
            'url' => $url,
            'lastOpen' => $lastOpen,
            'checkPay' => intval($checkPay),
        ]);
    }

    /**
     * @param $id
     * @param $bid
     * @return array
     */
    public function actionSell($id, $bid) {
        $item = Items::findOne($id);
        $user = User::getCurrentUser();
        $basket = Basket::find()
            ->where(['token_index' => $user->token_index])
            ->andWhere(['id' => $bid])
            ->one();

        if (!$user || !$item || !$basket) {
            echo json_encode(['code' => 500, 'msg' => 'Внутренняя ошибка']);
            exit;
        }

        if ($basket->item_id != $id) {
            echo json_encode(['code' => 500, 'msg' => 'Ошибка в запросе']);
            exit;
        }

        $user->money += $item->cost_sell;
        $user->save();

        $basket->delete();
        echo json_encode(['code' => 200, 'msg' => 'ok', 'balance' => $user->money]);
        exit;
    }

    public function actionUser($token) {
        $this->layout = 'clear';
        $user = User::findOne(['token_index' => $token]);
        if (!$user) {
            return $this->redirect(['index']);
        }

        $r = GameLog::find()
            ->select(['SUM(cost_real) as sum', 'COUNT(id) as cnt'])
            ->where(['token_index' => $user->token_index])
            ->groupBy('token_index')
            ->asArray()
            ->all();

        $cntBox = isset($r[0]['cnt']) ? $r[0]['cnt'] : 0;
        $cntSum = isset($r[0]['sum']) ? $r[0]['sum'] : 0;

        $items = GameLog::find()
            ->where(['token_index' => $user->token_index])
            ->orderBy(['id' => SORT_DESC])
            ->all();

        return $this->render('user', [
            'user' => $user,
            'cntBox' => $cntBox,
            'cntSum' => $cntSum,
            'items' => $items
        ]);
    }
}
