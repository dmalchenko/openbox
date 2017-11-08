<?php

namespace app\modules\opencase\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "game_log".
 *
 * @property integer $id
 * @property string $token
 * @property integer $token_index
 * @property integer $case_type
 * @property integer $item_id
 * @property integer $cost_real
 * @property integer $cost_sell
 * @property integer $created_at
 * @property integer $updated_at
 */
class GameLog extends \yii\db\ActiveRecord
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
        return 'game_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token_index', 'case_type', 'item_id', 'cost_real', 'cost_sell'], 'integer'],
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
            'case_type' => 'тип кейса',
            'item_id' => 'ид предмета',
            'created_at' => 'создан',
            'updated_at' => 'обновлен',
            'cost_real' => 'цена реальная',
            'cost_sell' => 'цена продажи',
        ];
    }
}
