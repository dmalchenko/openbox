<?php

namespace app\modules\opencase\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "basket".
 *
 * @property integer $id
 * @property string $token
 * @property integer $token_index
 * @property integer $item_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Items $items
 */
class Basket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'basket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token_index'], 'integer'],
            [['token'], 'string', 'max' => 255],
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
            'item_id' => 'ид предмета',
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
	public function getItems() {
		return $this->hasOne(Items::className(), ['id' => 'item_id']);
	}
}
