<?php
$merchantId = '7012';
$secretWord = 'secret';
$order_id = '154';
$order_amount = '100.11';
$sign = md5($merchantId . ':' . $order_amount . ':' . $secretWord . ':' . $order_id);


?>

<form method='get' action='http://www.free-kassa.ru/merchant/cash.php'>
    <input type='hidden' name='m' value='<?= $merchantId ?>'>
    <input type='hidden' name='oa' value='<?= $order_amount ?>'>
    <input type='hidden' name='o' value='<?= $order_id ?>'>
    <input type='hidden' name='s' value='<?= $sign ?>'>
    <input type='hidden' name='i' value='1'>
    <input type='hidden' name='lang' value='ru'>
    <input type='hidden' name='us_login' value='<?= $user['login'] ?>'>
    <input type='submit' name='pay' value='Оплатить'>
</form>