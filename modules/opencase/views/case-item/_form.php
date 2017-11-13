<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\opencase\models\CaseItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="case-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'case_type')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'item_id')->dropDownList($model->getItems()) ?>

    <?= $form->field($model, 'chance')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
