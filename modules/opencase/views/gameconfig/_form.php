<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\opencase\models\GameConfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-config-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'user_id')->textInput() ?>

	<?= $form->field($model, 'token')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'token_index')->textInput() ?>

	<?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'status')->dropDownList([0, 1]) ?>

	<?= $form->field($model, 'case_type')->dropDownList([
		100 => 100,
		250 => 250,
		500 => 500,
		1000 => 1000,
	]) ?>

	<?= $form->field($model, 'item_id')->dropDownList($model->findItems()) ?>

	<?= $form->field($model, 'chance')->textInput() ?>

    <div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
