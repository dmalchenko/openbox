<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= ''; //Html::a('Добавить пользователя в ручную', ['create'], ['class' => 'btn btn-success'])   ?>
    </p>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			[
				'attribute' => 'name',
				'format' => 'raw',
				'value' => function ($model) {
					return Html::a($model->name, ['view', 'id' => $model->id]);
				},
			],
			'service',
			'avatar',
			'token',
			[
				'attribute' => 'admin',
				'format' => 'raw',
				'label' => 'тип',
				'value' => function ($model) {
					return Html::tag(
						'span',
						$model->admin ? 'admin' : 'user',
						['class' => $model->admin ? 'label label-success' : 'label label-info']
					);
				},
			],
			'money',
			// 'created_at',
			// 'updated_at',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
