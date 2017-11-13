<?php

use yii\db\Migration;

class m171113_172250_create_table_case_item extends Migration
{
	public function up()
	{
		$this->createTable('case_item', [
			'id' => $this->primaryKey(),
			'case_type' => $this->integer(),
			'item_id' => $this->integer(),
			'chance' => $this->integer(),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer(),
		]);
	}

	public function down()
	{
		$this->dropTable('case_type');
	}
}
