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
 */
class Delivery extends \yii\db\ActiveRecord
{
	const COST = 300;
	const STATUS_INIT = 'init';
	const STATUS_APPROVED = 'approved';
	const STATUS_SEND = 'send';
	const STATUS_FINISH = 'finish';

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
            'token' => 'Token',
            'token_index' => 'Token Index',
            'delivery_address_id' => 'Delivery Address ID',
            'status' => 'Status',
            'message' => 'Track codes',
            'items' => 'Items',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
}
