<?php

use yii\db\Migration;

class m180204_075028_add_100 extends Migration
{
    public function safeUp()
    {
        $this->addColumn('free_case', 'pay', $this->integer());
    }

    public function safeDown()
    {
        echo "m180204_075028_add_100 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180204_075028_add_100 cannot be reverted.\n";

        return false;
    }
    */
}
