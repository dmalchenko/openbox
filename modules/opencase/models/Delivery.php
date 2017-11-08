<?php

namespace app\modules\opencase\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "delivery".
 *
 * @property integer $id
 * @property string $token
 * @property integer $token_index
 * @property integer $delivery_address_id
 * @property string $status
 * @property string $message
 * @property integer $items
 * @property integer $created_at
 * @property integer $updated_at
 * @property Items $item
 * @property DeliveryAddress $delivery
 */
class Delivery extends \yii\db\ActiveRecord
{
	const COST = 300;
	const STATUS_INIT = 'init';
	const STATUS_APPROVED = 'approved';
	const STATUS_SEND = 'send';
	const STATUS_FINISH = 'finish';

	public static $statuses = [
		self::STATUS_INIT => 'заявка на рассмотрении',
		self::STATUS_APPROVED => 'ожидается отправка',
		self::STATUS_SEND => 'отправлено',
		self::STATUS_FINISH => 'доставлено',
	];

	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token_index', 'delivery_address_id'], 'integer'],
            [['token', 'status', 'message'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'token' => 'пользователь',
            'token_index' => 'токен',
            'delivery_address_id' => 'ID адреса доставки',
            'status' => 'статус',
            'message' => 'почтовый трек',
            'items' => 'ид предмета',
            'created_at' => 'создан',
            'updated_at' => 'обновлен',
        ];
    }

	/**
	 * @return array
	 */
	public function behaviors() {
		return [
			TimestampBehavior::className(),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getItem() {
		return $this->hasOne(Items::className(), ['id' => 'items']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getDelivery() {
		return $this->hasOne(DeliveryAddress::className(), ['id' => 'delivery_address_id']);
	}
}
