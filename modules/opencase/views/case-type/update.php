<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\opencase\models\CaseType */

$this->title = 'Обновить кейс: ' . $model->name;
?>
<div class="case-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
