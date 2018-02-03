<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \app\modules\opencase\models\Settings */


?>

<div class="case-item-form">

    <h3>Free case settings</h3>
    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form-inline',
            'style' => ['margin-left' => '50px']
        ],
        'action' => '/admin/free-case/update?id=1'
    ]); ?>

    <?= $form->field($model, 'groupId')->textInput() ?>

    <?= $form->field($model, 'postId')->textInput() ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
