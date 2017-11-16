<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Предметы';
?>
<div class="items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?= Html::a('Добавить предмет', ['create'], ['class' => 'btn btn-success']) ?>
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
