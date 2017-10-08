<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

if (Yii::$app->getSession()->hasFlash('error')) {
	echo '<div class="alert alert-danger">' . Yii::$app->getSession()->getFlash('error') . '</div>';
}

?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <p class="lead">Do you already have an account on one of these sites? Click the logo to log in with it here:</p>
	<?php echo \nodge\eauth\Widget::widget(['action' => 'site/login-social']); ?>

</div>
