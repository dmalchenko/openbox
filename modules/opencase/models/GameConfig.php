<?php

namespace app\modules\opencase\models;

use Yii;

/**
 * This is the model class for table "game_config".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $token
 * @property integer $token_index
 * @property string $message
 * @property integer $status
 * @property integer $case_type
 * @property integer $item_id
 * @property integer $chance
 * @property integer $created_at
 * @property integer $updated_at
 */
class GameConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'token_index', 'status', 'case_type', 'item_id', 'chance', 'created_at', 'updated_at'], 'integer'],
            [['token', 'message'], 'string', 'max' => 255],
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
            'token' => 'Token',
            'token_index' => 'Token Index',
            'message' => 'Message',
            'status' => 'Status',
            'case_type' => 'Case Type',
            'item_id' => 'Item ID',
            'chance' => 'Chance',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
