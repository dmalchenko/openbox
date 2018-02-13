<?php

namespace app\modules\opencase\controllers;

use app\models\User;
use app\modules\opencase\models\Basket;
use app\modules\opencase\models\CaseItem;
use app\modules\opencase\models\FreeCase;
use app\modules\opencase\models\GameConfig;
use app\modules\opencase\models\GameLog;
use app\modules\opencase\models\Items;
use Yii;
use yii\web\Response;

class GameController extends OpenboxController {

	public $enableCsrfValidation = false;

	public function behaviors()
	{
		return [
			[
				'class' => 'yii\filters\HttpCache',
				'only' => ['index'],
				'lastModified' => function ($action, $params) {
					return time();
				},
			],
		];
	}

	/**
	 * @param integer $caseType
	 * @return mixed|string
	 */
	public function actionRun($caseType) {

		http_response_code(200);

		header('Expires: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');

        $id  = Yii::$app->getUser()->getIdentity()->getId();
        $user = User::findOne(['token_index' => crc32($id)]);

        if (!$user) {
            $r = [
                'code' => 400,
                'msg' => 'Пожалуйста авторизируйтесь или зарегистрируйтесь',
            ];
            echo json_encode($r);
            exit;
        }

		if ($user->money - $caseType < 0) {

            $r = [
                'code' => 402,
                'msg' => 'Недостаточно средств, пожалуйста пополните счет',
            ];
            echo json_encode($r);
            exit;
        }

        try {

            if ($caseType == 0) {
                if ($user->canOpenFreeCase()) {
                    $freeCase = new FreeCase();
                    $freeCase->token = $user->token_index;
                    $freeCase->last_open = time();
                    $freeCase->save();
                } else {
                    $r = ['code' => 403, 'msg' => 'Открыть сейчас этот кейс не возможно. Вы не выполнили все условия',];
                    echo json_encode($r);
                    exit;
                }
            }


            $user->money -= $caseType;
            $idWinItem = $this->getRandItem($caseType);
            $item = Items::findOne($idWinItem);

			$basket = new Basket();
			$basket->token = $user->token;
			$basket->token_index = crc32($user->token);
			$basket->item_id = $idWinItem;
			$basket->save();

			$log = new GameLog();
			$log->token = $user->token;
			$log->token_index = crc32($user->token);
			$log->case_type = $caseType;
			$log->item_id = $idWinItem;
			$log->cost_real = $item->cost_real;
			$log->cost_sell = $item->cost_sell;
			$log->save();

			$r = [
				'id' => $idWinItem,
				'caseType' => $caseType,
				'code' => 200,
				'balance' => $user->money,
				'img' => $item->image,
				'title' => $item->title,
				'cost_sell' => $item->cost_sell,
				'bid' => $basket->id,
			];

		} catch (\Exception $e) {
			$r = [
				'msg' => $e->getMessage(),
				'code' => 500,
			];
		}

		$user->save();
		http_response_code(200);
		echo json_encode($r);
		exit;
	}

	/**
	 * @param integer $caseType
	 * @return mixed
	 */
	public function getRandItem($caseType) {

		$user = \Yii::$app->getUser()->getId();
		$itemPersonalRaw = GameConfig::find()
			->select(['ci.item_id', 'game_config.chance'])
            ->join('INNER JOIN', 'case_item as ci', 'ci.id = game_config.item_id')
			->where(['game_config.token_index' => crc32($user)])
			->andWhere(['game_config.case_type' => $caseType])
			->andWhere(['game_config.status' => 1])
			->asArray()
			->all();
		//file_put_contents('rrr.txt', json_encode($itemPersonalRaw));

		$personalIds = [];
		foreach ($itemPersonalRaw as $itemPersonal) {
			$personalIds[] = $itemPersonal['item_id'];
		}

		$items = CaseItem::find()->where(['case_type' => $caseType])->all();

		$chancesMap = [];
		/**
		 * @var CaseItem $item
		 */
		foreach ($items as $item) {
			if (in_array($item->item_id, $personalIds)) {
				continue;
			}
			$chancesMap = array_merge($chancesMap, $item->getChance());
		}

		foreach ($itemPersonalRaw as $itemPersonal) {
			$personalChance = array_fill(0, intval($itemPersonal['chance']), intval($itemPersonal['item_id']));
			$chancesMap = array_merge($chancesMap, $personalChance);
		}

        if (2913623761 == crc32($user)) {
//            echo json_encode([$personalIds, $chancesMap]); exit;
        }

		shuffle($chancesMap);
		$count = count($chancesMap);
		$rand = rand(0, $count - 1);
		$randItem = $chancesMap[$rand];

		return $randItem;
	}


}
