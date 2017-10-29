<?php
/**
 * Created by PhpStorm.
 * User: dmalchenko
 * Date: 08.10.17
 * Time: 21:08
 */

namespace app\modules\opencase\models;


class CaseCost {
	const CASE_TYPE100 = 100;
	const CASE_TYPE250 = 250;
	const CASE_TYPE500 = 500;
	const CASE_TYPE1000 = 1000;

	public static function getCases () {
		return [
			'Case100' => self::CASE_TYPE100,
			'Case250' => self::CASE_TYPE250,
			'Case500' => self::CASE_TYPE500,
			'Case1000' => self::CASE_TYPE1000,
		];
	}
}