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
use app\modules\opencase\models\GameConfig;
use app\modules\opencase\models\GameLog;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class UserController extends \app\controllers\UserController {


	/**
	 * Displays a single User model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
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


	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = User::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}