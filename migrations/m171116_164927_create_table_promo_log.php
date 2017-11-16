<?php

use yii\db\Migration;

class m171116_164927_create_table_promo_log extends Migration
{
	public function up()
	{
		$this->createTable('promo_log', [
			'id' => $this->primaryKey(),
			'promocode' => $this->string(),
			'bonus' => $this->integer(),
			'token' => $this->integer(),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer(),
		]);
	}

	public function down()
	{
		$this->dropTable('promo_log');
	}
}
