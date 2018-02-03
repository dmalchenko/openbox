<?php

namespace app\modules\opencase\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "free_case_param".
 *
 * @property integer $id
 * @property integer $status
 * @property string $groupId
 * @property integer $postId
 * @property integer $created_at
 * @property integer $updated_at
 */
class FreeCase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'free_case_param';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'postId'], 'integer'],
            [['groupId'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'groupId' => 'Group ID',
            'postId' => 'Post ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }
}
