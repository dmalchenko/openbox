<?php

namespace app\modules\freekassa;

/**
 * freekassa module definition class
 */
class Module extends \yii\base\Module {
	/**
	 * @inheritdoc
	 */
	public $controllerNamespace = 'app\modules\freekassa\controllers';

	/**
	 * @inheritdoc
	 */
	public function init() {
		parent::init();

		\Yii::configure($this, require __DIR__ . '/config.php');
	}
}
