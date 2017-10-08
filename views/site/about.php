<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>


<?= \app\modules\freekassa\widgets\FreekassaWidget::widget(); ?>




<!--<form method='get' action='http://www.free-kassa.ru/merchant/cash.php'>-->
<!--    <input type='hidden' name='m' value='--><?//= $merchantId ?><!--'>-->
<!--    <input type='hidden' name='oa' value='--><?//= $order_amount ?><!--'>-->
<!--    <input type='hidden' name='o' value='--><?//= $order_id ?><!--'>-->
<!--    <input type='hidden' name='s' value='--><?//= $sign ?><!--'>-->
<!--    <input type='hidden' name='i' value='1'>-->
<!--    <input type='hidden' name='lang' value='ru'>-->
<!--    <input type='hidden' name='us_login' value='--><?//= $sign ?><!--'>-->
<!--    <input type='submit' name='pay' value='Оплатить'>-->
<!--</form>-->