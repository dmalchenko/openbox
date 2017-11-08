<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\opencase\models\Items */

$this->title = $model->title;
?>
<div class="items-view">

    <h1>Обновить предмет <?= Html::encode($this->title) ?></h1>

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
			'id',
			'title',
			'description',
			'cost_real',
			'cost_sell',
			'count',
			'image',
			[
				'attribute'=>'created_at',
                'format' => 'datetime'
			],
			[
				'attribute'=>'updated_at',
                'format' => 'datetime'
			]
		],
	]) ?>

    <?= Html::img($model->image)?>

</div>
