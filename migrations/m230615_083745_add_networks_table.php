<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230615_083745_add_networks_table
 */
class m230615_083745_add_networks_table extends Migration
{
    /*
    public function safeUp()
    {

    }
    public function safeDown()
    {
        echo "m230615_083745_add_networks_table cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable("networks", [
            "id" => Schema::TYPE_PK,
            "name" => Schema::TYPE_STRING,
            "ip" => Schema::TYPE_STRING,
            "mac" => Schema::TYPE_STRING,
        ]);
    }

    public function down()
    {
        $this->dropTable('news');
    }

}
