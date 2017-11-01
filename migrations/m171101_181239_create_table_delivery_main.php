<?php

use yii\db\Migration;

class m171101_181239_create_table_delivery_main extends Migration
{
	public function up()
	{
		$this->createTable('delivery', [
			'id' => $this->primaryKey(),
			'token' => $this->string(),
			'token_index' => $this->bigInteger(20),
			'delivery_address_id' => $this->integer(),
			'status' => $this->string(),
			'message' => $this->string(),
			'items' => $this->string(),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer(),
		]);

		$this->createIndex('da_idx', 'delivery', 'delivery_address_id');
		$this->createIndex('ti_idx', 'delivery', 'token_index');
		$this->createIndex('ca_idx', 'delivery', 'created_at');
		$this->createIndex('ua_idx', 'delivery', 'created_at');
	}

	public function down()
	{
		$this->dropTable('delivery');
	}
}
