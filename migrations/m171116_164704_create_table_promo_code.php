<?php

use yii\db\Migration;

class m171116_164704_create_table_promo_code extends Migration
{
	public function up()
	{
		$this->createTable('promo_codes', [
			'id' => $this->primaryKey(),
			'promocode' => $this->string(),
			'bonus' => $this->integer(),
			'count' => $this->integer(),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer(),
		]);
	}

	public function down()
	{
		$this->dropTable('promo_codes');
	}
}
