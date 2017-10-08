<?php

use yii\db\Migration;

/**
 * Handles the creation of table `items`.
 */
class m171008_161641_create_items_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('items', [
            'id' => $this->primaryKey(),
			'title' => $this->string(),
			'description' => $this->string(),
			'cost_real' => $this->integer(),
			'cost_sell' => $this->integer(),
			'count' => $this->integer(),
			'image' => $this->string(),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('items');
    }
}
