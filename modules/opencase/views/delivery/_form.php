<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\opencase\models\Delivery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="delivery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'token')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'token_index')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'delivery_address_id')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(\app\modules\opencase\models\Delivery::$statuses) ?>

    <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
