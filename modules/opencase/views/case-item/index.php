<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $type integer */

$this->title = 'Предметы';
?>
<div class="items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h3><?= Html::encode("Кейс $type RUB") ?></h3>

    <p>
        <?php
        if ($type == 0) {
            echo Html::a('Settings free case', ['/admin/free-case/update', 'id' => 1], ['class' => 'btn btn-default']);
        }
        ?>
    </p>
    <p>
        <?= Html::a('Добавить предмет', ['create', 'caseType' => $type], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'item.title',
            'item.id',
            'item.cost_real',
            'item.cost_sell',
            'chance',
            'image' => [
                'value' => function (\app\modules\opencase\models\CaseItem $model) {
                    if (isset($model->item->image)) {
                        return Html::img($model->item->image);
                    }
                    return null;
                },
                'label' => 'картинка',
                'format' => 'raw'
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime'
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'datetime'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
