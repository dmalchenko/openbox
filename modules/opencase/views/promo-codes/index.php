<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $dataProviderPromoLog yii\data\ActiveDataProvider */

$this->title = 'Партнерка';
?>
<div class="promo-codes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добваить промо-код', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'promocode',
            'bonus',
            'count',
            'created_at:datetime',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <h1>Статистика</h1>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPromoLog,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user.name',
            'token_gived',
            'promocode',
            'bonus',
            'created_at:datetime',
        ],
    ]); ?>
</div>
