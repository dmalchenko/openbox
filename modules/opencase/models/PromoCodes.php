<?php

namespace app\modules\opencase\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "promo_codes".
 *
 * @property integer $id
 * @property string $promocode
 * @property integer $bonus
 * @property integer $count
 * @property integer $created_at
 * @property integer $updated_at
 */
class PromoCodes extends \yii\db\ActiveRecord
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
        return 'promo_codes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bonus', 'count'], 'integer'],
            [['promocode'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'promocode' => 'Промокод',
            'bonus' => 'Бонус',
            'count' => 'Активаций',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
        ];
    }
}
