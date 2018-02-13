<?php

use yii\db\Migration;

class m180203_073613_free_case_settings extends Migration
{
    public function up()
    {
        $this->createTable('free_case_param', [
            'id' => $this->primaryKey(),
            'status' => $this->integer()->defaultValue(1),
            'groupId' => $this->string(),
            'postId' => $this->integer(),
            'link' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('free_case_param');
    }
}
