<?php

namespace app\modules\opencase\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

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
 *
 * @property Items $item
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

	public function behaviors() {
		return [
			TimestampBehavior::className(),
		];
	}

	public function beforeSave($insert) {

    	if ($insert) {
			$this->token_index = crc32($this->token);
		}
    	return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'token' => 'пользователь',
            'token_index' => 'токен',
            'message' => 'сообщение',
            'status' => 'статус',
            'case_type' => 'тип кейса',
            'item_id' => 'ид предмета',
            'chance' => 'шанс',
            'created_at' => 'создан',
            'updated_at' => 'обновлен',
        ];
    }

	public function getItem() {
		return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }

	public function findItems() {
		$array = Items::find()->select(["id, concat(title, '(', case_type, ')') as title"])->asArray()->all();
		$result = ArrayHelper::map($array, 'id', 'title');
    	return $result;
	}
}
