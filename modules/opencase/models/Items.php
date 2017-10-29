<?php

namespace app\modules\opencase\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "items".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $cost_real
 * @property integer $cost_sell
 * @property integer $count
 * @property integer $case_type
 * @property string $image
 * @property integer $created_at
 * @property integer $updated_at
 */
class Items extends \yii\db\ActiveRecord
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
        return 'items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cost_real', 'cost_sell', 'count', 'case_type', 'created_at', 'updated_at'], 'integer'],
            [['title', 'description', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'cost_real' => 'Cost Real',
            'cost_sell' => 'Cost Sell',
            'count' => 'Chance',
            'case_type' => 'Case_type',
            'image' => 'Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

	public function getChance() {
		return array_fill(0, $this->count, $this->id);
    }
}
