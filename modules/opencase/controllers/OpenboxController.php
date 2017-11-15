<?php
/**
 * Created by PhpStorm.
 * User: dmalchenko
 * Date: 15.11.17
 * Time: 19:16
 */

namespace app\modules\opencase\controllers;


use app\models\User;
use Yii;
use yii\web\Controller;

class OpenboxController extends Controller {

	public function beforeAction($action) {

		if (!parent::beforeAction($action)) {
			return false;
		}

		if (!Yii::$app->user->isGuest && User::getCurrentUser()->admin) {
			return true;
		} else {
			$this->redirect(['/site/index']);
		}
		return true;
	}
}