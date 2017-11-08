<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\opencase\models\GameConfig */

$this->title = 'Добавить подкрутку';
?>
<div class="game-config-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
