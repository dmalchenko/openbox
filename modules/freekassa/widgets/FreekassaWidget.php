<?php

namespace app\modules\freekassa\widgets;

use app\modules\freekassa\models\Freekassa;
use yii\base\Widget;

class FreekassaWidget extends Widget {

	public function init() {
		parent::init();
	}

	public function run() {
		$model = new Freekassa();
		return $this->render('_formFreekassa', ['model' => $model]);
	}
}
