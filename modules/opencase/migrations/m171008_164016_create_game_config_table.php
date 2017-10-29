<?php

use yii\db\Migration;

/**
 * Handles the creation of table `game_config`.
 */
class m171008_164016_create_game_config_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('game_config', [
            'id' => $this->primaryKey(),
			'user_id' => $this->integer(),
			'token' => $this->string(),
			'token_index' => $this->bigInteger(20),
			'message' => $this->string(),
			'status' =>$this->integer(),
			'case_type' => $this->integer(),
			'item_id' => $this->integer(),
			'chance' => $this->integer(),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer(),
        ]);

        $this->createIndex('idx_gc_token_index', 'game_config', 'token_index');
        $this->createIndex('idx_gc_item_id', 'game_config', 'item_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
    	$this->dropIndex('idx_gc_token_index', 'game_config');
    	$this->dropIndex('idx_gc_item_id', 'game_config');
        $this->dropTable('game_config');
    }
}
