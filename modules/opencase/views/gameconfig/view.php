<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\opencase\models\GameConfig */

$this->title = $model->id;
?>
<div class="game-config-view">

    <h1>Обновить подкрутку</h1>

    <p>
		<?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Удалить', ['delete', 'id' => $model->id], [
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
			[
				'attribute' => 'user.name',
				'value' => function (\app\modules\opencase\models\GameConfig $model) {
					return Html::a($model->user->name, Url::toRoute(['user/view', 'id' => $model->user->id]));
				},
                'format' => 'raw'
			],
			'token_index',
			'status',
			'case_type',
			'item_id',
			'chance',
			'created_at:datetime',
			'updated_at:datetime',
		],
	]) ?>

</div>
