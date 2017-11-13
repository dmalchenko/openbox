<?php

namespace app\modules\opencase;

/**
 * opencase module definition class
 */
class Module extends \yii\base\Module {
	/**
	 * @inheritdoc
	 */
	public $controllerNamespace = 'app\modules\opencase\controllers';

	/**
	 * @inheritdoc
	 */
	public function init() {
		parent::init();
		$this->layout = '@app/modules/opencase/views/layouts/main.php';
		// custom initialization code goes here
	}

}
