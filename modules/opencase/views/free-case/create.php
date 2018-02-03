<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FreeCase */

$this->title = 'Create Free Case';
$this->params['breadcrumbs'][] = ['label' => 'Free Cases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="free-case-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
