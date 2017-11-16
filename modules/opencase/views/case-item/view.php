<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\opencase\models\CaseItem */

$this->title = $model->item->title;
?>
<div class="case-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('удалить', ['delete', 'id' => $model->id], [
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
			'case_type',
			'item_id',
			'chance',
			'item.title',
			'item.image' => [
				'value' => function (\app\modules\opencase\models\CaseItem $model) {
					if (isset($model->item->image)) {
						return Html::img($model->item->image);
					}
					return null;
				},
				'format' => 'raw',
				'label' => 'картинка'
			],
			'item.cost_real',
			'created_at:datetime',
			'updated_at:datetime',
		],
	]) ?>

</div>
