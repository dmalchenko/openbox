<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\opencase\models\GameConfig */

$this->title = 'Create Game Config';
$this->params['breadcrumbs'][] = ['label' => 'Game Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-config-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
