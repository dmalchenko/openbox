<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Персональные подкрутки';
?>
<div class="game-config-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('Добавить подкрутку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
//			'user_id',
			[
				'attribute' => 'user.name',
				'value' => function (\app\modules\opencase\models\GameConfig $model) {
					if (isset($model->user)) {
						return Html::a($model->user->name, Url::toRoute(['user/view', 'id' => $model->user->id]));
					} else {
						return null;
					}
				},
				'format' => 'raw'
			],
			'token_index',
			'status',
			'case_type',
			'item_id' => [
				'value' => function (\app\modules\opencase\models\GameConfig $model) {
					return Html::a($model->item->title, ['/opencase/item/view', 'id' => $model->item_id]);
				},
				'label' => 'предмет',
				'format' => 'raw'
			],
			'item_img' => [
				'value' => function (\app\modules\opencase\models\GameConfig $model) {
					return Html::img($model->item->image);
				},
				'label' => 'картинка',
				'format' => 'raw'
			],
			'chance',
			// 'message',
			// 'created_at',
			// 'updated_at',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
