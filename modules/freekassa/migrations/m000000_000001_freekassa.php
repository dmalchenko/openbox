<?php

use yii\db\Migration;

class m000000_000001_freekassa extends Migration
{
    public function safeUp()
    {
		$this->createTable('freekassa',[
			'id' => $this->primaryKey(),
			'name' => $this->string(),
			'description' => $this->string(),
			'message' => $this->string(),
			'currency' => $this->integer(),
			'amount' => $this->integer(),
			'status' => $this->integer(),
			'user_id' => $this->integer(),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer(),
		]);
    }

    public function safeDown()
    {
    	$this->dropTable('freekassa');

        echo "m000000_000001_freekassa reverted.\n";

        return true;
    }
}
