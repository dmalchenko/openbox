<?php

namespace app\modules\opencase\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "delivery_address".
 *
 * @property integer $id
 * @property integer $token_index
 * @property string $name
 * @property string $country
 * @property string $city
 * @property string $street
 * @property string $home
 * @property string $room
 * @property string $index
 * @property integer $created_at
 * @property integer $updated_at
 */
class DeliveryAddress extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'delivery_address';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['token_index', 'created_at', 'updated_at'], 'integer'],
			[['name', 'country', 'city', 'street', 'home', 'room', 'index'], 'string', 'max' => 255],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id' => 'ID',
			'token_index' => 'Token Index',
			'name' => 'Name',
			'country' => 'Country',
			'city' => 'City',
			'street' => 'Street',
			'home' => 'Home',
			'room' => 'Room',
			'index' => 'Index',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	public function behaviors() {
		return [
			TimestampBehavior::className(),
		];
	}

	public function findAddress() {
		$address = array_filter([$this->country, $this->city, $this->street, $this->home, $this->room]);
		return implode(', ', $address);
	}
}
