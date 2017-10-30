<?php

use yii\db\Migration;

class m171030_183625_create_table_game_log extends Migration
{
    public function safeUp()
    {
		$this->createTable('game_log', [
			'id' => $this->primaryKey(),
			'token' => $this->string(),
			'token_index' => $this->bigInteger(20),
			'case_type' => $this->integer(),
			'item_id' => $this->integer(),
			'cost_real' => $this->integer(),
			'cost_sell' => $this->integer(),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer(),
		]);
    }

    public function safeDown()
    {
       $this->dropTable('game_log');
    }

}
