<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\opencase\models\Items */

$this->title = 'Добавить предмет';
?>
<div class="items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
