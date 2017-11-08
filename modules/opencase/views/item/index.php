<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $type integer */

$this->title = 'Предметы';
?>
<div class="items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h3><?= Html::encode("Кейс $type RUB") ?></h3>
    <p>
    <?= Html::a('Добавить предмет', ['create', 'caseType' => $type], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			'title',
			'description',
			'cost_real',
			'cost_sell',
			'count',
            'image' => [
                'value' => function(\app\modules\opencase\models\Items $model) {
					return Html::img($model->image);
                },
                'label' => 'картинка',
                'format' => 'raw'
            ],
			[
				'attribute'=>'created_at',
				'format' => 'datetime'
			],
			[
				'attribute'=>'updated_at',
				'format' => 'datetime'
			],

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
