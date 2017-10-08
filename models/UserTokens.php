<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user_tokens".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $service
 * @property string $token
 * @property integer $token_index
 * @property integer $money
 * @property integer $created_at
 * @property integer $updated_at
 */
class UserTokens extends \yii\db\ActiveRecord
{
	public function behaviors() {
		return [
			TimestampBehavior::className(),
		];
	}

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_tokens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'token_index', 'money', 'created_at', 'updated_at'], 'integer'],
            [['name', 'token', 'service'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'service' => 'Service',
            'token' => 'Token',
            'token_index' => 'Token Index',
            'money' => 'Money',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
