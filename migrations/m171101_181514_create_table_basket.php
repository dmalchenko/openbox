<?php

use yii\db\Migration;

class m171101_181514_create_table_basket extends Migration
{
	public function up()
	{
		$this->createTable('basket', [
			'id' => $this->primaryKey(),
			'token' => $this->string(),
			'token_index' => $this->bigInteger(20),
			'item_id' => $this->integer(),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer(),
		]);

		$this->createIndex('ti_idx', 'basket', 'token_index');
		$this->createIndex('items_idx', 'basket', 'item_id');
		$this->createIndex('ca_idx', 'basket', 'created_at');
		$this->createIndex('ua_idx', 'basket', 'created_at');
	}

	public function down()
	{
		$this->dropTable('basket');
	}
}
