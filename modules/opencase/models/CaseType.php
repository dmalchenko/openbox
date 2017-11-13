<?php
/**
 * Created by PhpStorm.
 * User: dmalchenko
 * Date: 08.10.17
 * Time: 21:08
 */

namespace app\modules\opencase\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "case_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $created_at
 * @property integer $updated_at
 */
class CaseType extends \yii\db\ActiveRecord
{
	const CASE_TYPE100 = 100;
	const CASE_TYPE250 = 250;
	const CASE_TYPE500 = 500;
	const CASE_TYPE1000 = 1000;

	public function behaviors() {
		return [
			TimestampBehavior::className()
		];
	}

	public static function getCases () {
		return self::find()->all();
	}

	public static function getCasesArray () {
		$cases = self::find()->select(['type', 'name'])->asArray()->all();
		return ArrayHelper::map($cases, 'type', 'name');
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'case_type';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['type'], 'integer'],
			[['name'], 'string', 'max' => 255],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
			'type' => 'Type',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}
}
