<?php

namespace app\modules\freekassa\controllers;

use app\models\User;
use app\modules\freekassa\models\Freekassa;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Default controller for the `freekassa` module
 */
class PaymentController extends Controller {

	const URL_GET_BALANCE = 'http://www.free-kassa.ru/api.php?merchant_id=%s&s=%s&action=get_balance';
	const URL_GET_CASH = 'http://www.free-kassa.ru/merchant/cash.php?m=%s&oa=%s&o=%s&s=%s&lang=ru&us_id=%s';

	public function actionPay() {
		$remoteIp = isset($_SERVER['HTTP_X_REAL_IP']) ? $_SERVER['HTTP_X_REAL_IP'] : $_SERVER['REMOTE_ADDR'];

		if (in_array($remoteIp, array('136.243.38.147', '136.243.38.149', '136.243.38.150', '136.243.38.151', '136.243.38.189', '88.198.88.98'))) {
			exit("hacking attempt!");
		}
		$orderAmount = $_REQUEST['AMOUNT'];
		$orderId = $_REQUEST['MERCHANT_ORDER_ID'];

		$model = Freekassa::findOne($orderId);

		if (!($model->amount && $model->amount == $orderAmount)) {
			$model->status = Freekassa::STATUS_FAIL;
			$model->description = 'amount not real';
			$model->save();
			exit($model->description);
		}

		$sign = $model->getSign('merchantSecret2');
		if ($sign != $_REQUEST['SIGN']) {
			$model->status = Freekassa::STATUS_FAIL;
			$model->description = 'wrong sign';
			$model->save();
			exit($model->description);
		}

		$model->status = Freekassa::STATUS_SUCCESS;
		$model->description = 'pay OK';
		$model->save();
		$model->userAddMoney();
		exit('YES');
	}

	public function actionBalance() {
		$module = \Yii::$app->controller->module;
		$merchantId = $module->params['merchantId'];
		$merchantSecret2 = $module->params['merchantSecret2'];
		$hash = md5($merchantId . $merchantSecret2);
		$url = sprintf(self::URL_GET_BALANCE, $merchantId, $hash);
		return file_get_contents($url);
	}

	public function actionCreate() {

		$user = User::getCurrentUser();

		$currency = intval(\Yii::$app->request->get('ctype'));
		$amount = intval(\Yii::$app->request->get('sum'));
		if (!$amount || $amount <= 0 || !$user) {
			return $this->goHome();
		}

		$model = new Freekassa();
		$userId = $user->token_index;

		$model->amount = $amount;
		$model->currency = $currency;
		$model->status = Freekassa::STATUS_CREATED;
		$model->user_id = $userId;


		if ($model->save()) {
			$module = \Yii::$app->controller->module;
			$merchantId = $module->params['merchantId'];

			$url = sprintf(self::URL_GET_CASH, $merchantId, $model->amount, $model->id, $model->getSign('merchantSecret'), $userId);
			return $this->redirect($url);
		} else {
			throw new BadRequestHttpException('Bad data for request');
		}
	}

}
