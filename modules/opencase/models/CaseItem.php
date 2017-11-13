<?php

namespace app\modules\opencase\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "case_item".
 *
 * @property integer $id
 * @property integer $case_type
 * @property integer $item_id
 * @property integer $chance
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Items $item
 */
class CaseItem extends \yii\db\ActiveRecord
{
	public function behaviors() {
		return [
			TimestampBehavior::className()
		];
	}

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'case_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['case_type', 'item_id', 'chance'], 'integer'],
            [['case_type', 'item_id', 'chance'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'case_type' => 'тип кейса',
            'item_id' => 'Item ID',
            'chance' => 'шанс',
            'created_at' => 'создан',
            'updated_at' => 'обновлен',
        ];
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getItem() {
		return $this->hasOne(Items::className(), ['id' => 'item_id']);
	}

	public function getItems() {
		$items = Items::find()->select(['id', 'title'])->asArray()->all();
		$items = ArrayHelper::map($items, 'id', 'title');
		return $items;
	}

	public function getChance() {
		return array_fill(0, $this->chance, $this->item_id);
	}

}
