<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\opencase\models\CaseItem */

$this->title = 'Добавить предмет к кейсу';
?>
<div class="case-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
