<?php

/** @var $model \app\modules\freekassa\models\Freekassa */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['action' => ['/freekassa/payment/create'], 'options' => ['method' => 'post']]); ?>

<?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'name')->hiddenInput(['value' => 'Пополнение кошелька'])->label(false) ?>

<div class="form-group">
	<?= Html::submitButton('Пополнить', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
