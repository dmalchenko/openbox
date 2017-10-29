<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_tokens`.
 */
class m171008_122230_create_user_tokens_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
			'user_id' => $this->integer(),
			'name' => $this->string(),
			'service' => $this->string(),
			'avatar' => $this->string(),
			'token' => $this->string(),
			'token_index' => $this->bigInteger(20),
			'money' => $this->integer(),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
