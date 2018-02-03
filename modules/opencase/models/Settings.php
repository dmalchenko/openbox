<?php

namespace app\modules\opencase\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property integer $status
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 */
class Settings extends \yii\db\ActiveRecord {
    public $groupId;
    public $postId;
    public $status;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['status'], 'integer'],
            [['postId', 'groupId'], 'integer'],
            [['data'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
     * @param bool $runValidation
     * @param null $attributeNames
     * @return bool
     */
    public function save($runValidation = true, $attributeNames = null) {
        $this->data = json_encode([
            'groupId' => $this->groupId,
            'postId' => $this->postId,
        ]);
        return parent::save($runValidation = true, $attributeNames = null);
    }

    public function getGroupId() {
        if ($this->groupId) {
            return $this->groupId;
        }
        return json_decode($this->data, true)['groupId'];
    }

    public function getPostId() {
        if ($this->postId) {
            return $this->postId;
        }
        return json_decode($this->data, true)['postId'];
    }

}
