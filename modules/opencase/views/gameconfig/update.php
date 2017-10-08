<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\opencase\models\GameConfig */

$this->title = 'Update Game Config: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Game Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="game-config-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
