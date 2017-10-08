<?php
/**
 * Created by PhpStorm.
 * User: dmalchenko
 * Date: 08.10.17
 * Time: 16:30
 */

namespace app\models;

use nodge\eauth\services\OdnoklassnikiOAuth2Service as OK;


class OdnoklassnikiOAuth2Service extends OK{
	protected $baseApiUrl = 'https://api.ok.ru/fb.do';

}