<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $type integer */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h3><?= Html::encode("Case $type RUB") ?></h3>
    <p>
    <?= Html::a('Create Items', ['create', 'caseType' => $type], ['class' => 'btn btn-success']) ?>
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
//             'image',
			'created_at',
			'updated_at',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
