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

            [
                'attribute' => 'user',
                'format' => 'raw',
                'value' => function (\app\modules\freekassa\models\Freekassa $model) {
                    if (isset($model->user) && $partner = $model->user) {
                        return Html::a($partner->name, ['/admin/user/view', 'id' => $partner->id]);
                    } else {
                        return 'vsebox';
                    }
                },
            ],
//            'partner',
            [
                'attribute' => 'promo.token_gived',
                'format' => 'raw',
                'value' => function (\app\modules\freekassa\models\Freekassa $model) {
                    if (isset($model->promo->token_gived) && $partner = $model->promo->token_gived) {
//                        return Html::a($partner->username, ['/admin/user/view', 'id' => $partner->id]);
                        return $partner;
                    } else {
                        return 'vsebox';
                    }
                },
            ],
            'amount:raw:Пополнение',
            'created_at:datetime',
        ],
    ]); ?>
</div>
