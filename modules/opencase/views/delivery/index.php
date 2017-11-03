<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Deliveries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'token_index',
			[
                'attribute' => 'delivery_address_id',
                'value' => function(\app\modules\opencase\models\Delivery $model) {
	                return $model->delivery->findAddress();
                }
            ],
			[
                'attribute' => 'status',
				'value' => function (\app\modules\opencase\models\Delivery $model) {
	                return \app\modules\opencase\models\Delivery::$statuses[$model->status];
                }
			],
			'message',
			[
				'value' => function (\app\modules\opencase\models\Delivery $model) {
					return $model->item->title;
				},
				'attribute' => 'items',
				'format' => 'raw'
			],
			[
				'value' => function (\app\modules\opencase\models\Delivery $model) {
					return Html::img($model->item->image);
				},
				'attribute' => 'image',
				'format' => 'raw'
			],
			[
				'attribute' => 'created_at',
				'format' => 'datetime'
			],
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
