<?php
/**
 * Created by PhpStorm.
 * User: dmalchenko
 * Date: 08.10.17
 * Time: 15:43
 */

namespace app\modules\freekassa\models;


interface Freekassable {

	public static function setMoney($user_id, $money);

	public static function addMoney($user_id, $money);

}