<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\opencase\models\CaseItem */

$this->title = 'Обновить: ' . $model->item->title;

?>
<div class="case-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
