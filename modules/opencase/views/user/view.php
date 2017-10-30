<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $gameConfigDataProvider \yii\data\ActiveDataProvider */
/* @var $gameLogDataProvider \yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Are you sure you want to delete this item?',
				'method' => 'post',
			],
		]) ?>
    </p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'name',
			'service',
			'avatar',
			'token',
			'token_index',
			'money',
			[
				'attribute' => 'created_at',
				'format' => 'raw',
				'value' => function ($model) {
					return date("Y-m-d H:i:s", $model->created_at);
				},
			],
			[
				'attribute' => 'updated_at',
				'format' => 'raw',
				'value' => function ($model) {
					return date("Y-m-d H:i:s", $model->updated_at);
				},
			],
		],
	]) ?>

    <h1><?= Html::encode('Personal game config') ?></h1>

	<?= GridView::widget([
		'dataProvider' => $gameConfigDataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'token',
			'token_index',
			'status',
			'case_type',
			'item_id',
			'chance',
			'edit' => [
				'attribute' => 'action',
				'format' => 'raw',
				'value' => function (\app\modules\opencase\models\GameConfig $model) {
					return Html::a('Edit', ['/opencase/gameconfig/update', 'id' => $model->id]);
				}
			],
		],
	]); ?>

    <h1><?= Html::encode('Game logs') ?></h1>

    <?= GridView::widget([
		'dataProvider' => $gameLogDataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'token',
			'case_type',
			'item_id',
			'cost_real',
			'cost_sell',
		],
	]); ?>

</div>
