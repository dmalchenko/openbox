<?php

namespace app\modules\freekassa\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "freekassa".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $message
 * @property integer $currency
 * @property integer $amount
 * @property integer $status
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Freekassa extends ActiveRecord {

	const STATUS_CREATED = 1;
	const STATUS_SUCCESS = 2;
	const STATUS_FAIL = 3;
	private $merchantId;
	private $secretWord;

	public function initFreekassa() {
		$this->merchantId = \Yii::$app->controller->module->params['merchantId'];
		$this->secretWord = \Yii::$app->controller->module->params['secretWord'];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'freekassa';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['currency', 'amount', 'status', 'user_id', 'created_at', 'updated_at'], 'integer'],
			[['name', 'description', 'message'], 'string', 'max' => 255],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'message' => 'Message',
			'currency' => 'Currency',
			'amount' => 'Amount',
			'status' => 'Status',
			'user_id' => 'User ID',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	public function behaviors() {
		return [
			TimestampBehavior::className(),
		];
	}

	public static function getCurrency() {
		return \Yii::$app->controller->module->params['currency'];
	}

	public function getSign() {
		$merchantId = \Yii::$app->controller->module->params['merchantId'];
		$secretWord = \Yii::$app->controller->module->params['secretWord'];
		$sign = md5($merchantId . ':' . $this->amount . ':' . $secretWord . ':' . $this->id);
		return $sign;
	}

	public function userAddMoney() {
		$userMoneyField = \Yii::$app->controller->module->params['userMoneyField'];
		$user = $this->getUser();
		$user->$userMoneyField += $this->amount;
		$user->save();
	}

	/**
	 * @return ActiveRecord
	 */
	private function getUser() {
		$userClass = \Yii::$app->controller->module->params['userClass'];
		$user = $userClass::findOne($this->user_id);
		return $user;
	}

}