<?php

namespace app\modules\opencase\controllers;

use app\modules\opencase\models\GameConfig;
use app\modules\opencase\models\Items;

class GameController extends \yii\web\Controller {
	public function actionRun() {


		$this->getRandItem(100);

	}

	public function getRandItem($caseType) {

		$user = \Yii::$app->getUser()->getId();
		$itemPersonal = GameConfig::find()
			->where(['user_id' => $user])
			->andWhere(['case_type' => $caseType])
			->all();

		var_dump($user);
		exit;

		$items = Items::find()->where(['case_type' => $caseType])->all();
		$chancesMap = [];
		/**
		 * @var Items $item
		 */
		foreach ($items as $item) {
			$chancesMap = array_merge($chancesMap, $item->getChance());
		}
		shuffle($chancesMap);
		$count = count($chancesMap);
		$rand = rand(0, $count - 1);
		$randItem = $chancesMap[$rand];

		return $randItem;
	}


}
