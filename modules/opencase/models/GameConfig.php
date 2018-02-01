<?php

namespace app\modules\opencase\models;

use app\models\User;
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
 * @property CaseItems $caseItem
 * @property User $user
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
			$user = User::findOne(['token_index' => $this->token_index]);
			if ($user) {
				$this->token = $user->token;
			}
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

	public function getCaseItem() {
		return $this->hasOne(CaseItem::className(), ['id' => 'item_id']);
    }

	public function findItems() {
		$array = CaseItem::find()
            ->select(["case_item.id, concat(i.title, '(', case_item.case_type, ')') as title"])
            ->join('INNER JOIN', 'items as i', 'i.id = case_item.item_id')
            ->orderBy('case_item.case_type')
            ->asArray()
            ->all();
		$result = ArrayHelper::map($array, 'id', 'title');
    	return $result;
	}

	public function findUsers() {
		$users = User::find()->asArray()->all();
		$users = ArrayHelper::map($users, 'token_index', function($v) {
			return sprintf('%s (%s)', $v['name'], $v['token']);
		});
		return $users;
	}

	public function getUser() {
		return $this->hasOne(User::className(), ['token_index' => 'token_index']);
	}

}
