<?php

namespace app\modules\opencase\models;

use app\models\User;
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
 *
 * @property User $user
 * @property User $partner
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
			'promocode' => 'Промокод',
			'bonus' => 'Бонус',
			'token' => 'Пользователь',
			'token_gived' => 'Партнер',
			'partner' => 'Партнер',
			'created_at' => 'Активирован',
			'updated_at' => 'Обнавлен',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser() {
		if (isset($this->token)) {
			return $this->hasOne(User::className(), ['token_index' => 'token']);
		}
		return null;
	}

	public function getPartner() {
		if (isset($this->token_gived)) {
			$user = User::findOne(['token_index' => $this->token_gived]);
			if ($user) {
				return $user->name;
			}
		}
		return 'VseBox';
	}
}
