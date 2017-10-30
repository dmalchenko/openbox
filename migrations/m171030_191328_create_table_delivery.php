<?php

use yii\db\Migration;

class m171030_191328_create_table_delivery extends Migration
{
	public function up()
	{
		$this->createTable('delivery_address', [
			'id' => $this->primaryKey(),
			'token_index' => $this->bigInteger(20),
			'name' => $this->string(),
			'country' => $this->string(),
			'city' => $this->string(),
			'street' => $this->string(),
			'home' => $this->string(),
			'room' => $this->string(),
			'index' => $this->string(),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer(),
		]);
	}

    public function down()
    {
        $this->dropTable('delivery_address');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171030_191328_create_table_delivery cannot be reverted.\n";

        return false;
    }
    */
}
