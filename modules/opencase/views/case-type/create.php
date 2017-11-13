<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\opencase\models\CaseType */

$this->title = 'Добавить кейс';
?>
<div class="case-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
