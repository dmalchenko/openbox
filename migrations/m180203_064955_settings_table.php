<?php

use yii\db\Migration;

class m180203_064955_settings_table extends Migration
{
    public function up()
    {
        $this->createTable('settings', [
            'id' => $this->primaryKey(),
            'status' => $this->integer()->defaultValue(1),
            'data' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createTable('free_case', [
            'id' => $this->primaryKey(),
            'token' => $this->bigInteger(20),
            'last_open' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);


    }

    public function down()
    {
        $this->dropTable('free_case');
        $this->dropTable('settings');
    }
}
