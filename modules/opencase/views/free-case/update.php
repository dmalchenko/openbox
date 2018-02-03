<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FreeCase */

$this->title = 'Update Free Case: ' . $model->id;
?>
<div class="free-case-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
