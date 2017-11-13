<?php

use yii\db\Migration;

class m171113_171246_create_table_case_type extends Migration
{
	public function up()
	{
		$this->createTable('case_type', [
			'id' => $this->primaryKey(),
			'name' => $this->string(),
			'type' => $this->integer(),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer(),
		]);
	}

	public function down()
	{
		$this->dropTable('case_type');
	}
}
