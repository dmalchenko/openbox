<?php

namespace app\modules\opencase\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "promo_log".
 *
 * @property integer $id
 * @property string $promocode
 * @property integer $bonus
 * @property integer $token
 * @property integer $token_gived
 * @property integer $created_at
 * @property integer $updated_at
 */
class PromoLog extends \yii\db\ActiveRecord {
	public function behaviors() {
		return [
			TimestampBehavior::className(),
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'promo_log';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['bonus', 'token', 'created_at', 'updated_at'], 'integer'],
			[['promocode'], 'string', 'max' => 255],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id' => 'ID',
			'promocode' => 'Promocode',
			'bonus' => 'Bonus',
			'token' => 'Token',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}
}
