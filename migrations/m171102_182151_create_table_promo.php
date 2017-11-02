<?php

use yii\db\Migration;

class m171102_182151_create_table_promo extends Migration {
	public function safeUp() {
		$this->createTable('promo', [
			'id' => $this->primaryKey(),
			'token' => $this->string(),
			'token_index' => $this->bigInteger(20),
			'parent_index' => $this->bigInteger(20),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer(),
		]);

		$this->createIndex('ti_idx', 'promo', 'token_index');
		$this->createIndex('pa_idx', 'promo', 'parent_index');
		$this->createIndex('ca_idx', 'promo', 'created_at');
		$this->createIndex('ua_idx', 'promo', 'created_at');
	}

	public function safeDown() {
		$this->dropTable('promo');
		return true;
	}

}
