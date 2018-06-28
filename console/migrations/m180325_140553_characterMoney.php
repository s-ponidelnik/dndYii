<?php

use yii\db\Migration;

/**
 * Class m180325_140553_characterMoney
 */
class m180325_140553_characterMoney extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%character_money}}', [
            'id' => $this->primaryKey()->unsigned(),
            'character_id' => $this->integer()->unsigned(),
            'currency_type_id' => $this->integer()->unsigned()->null(),
            'count' => $this->integer()->unsigned(),
        ], $tableOptions);

        $this->addForeignKey('character_money_currency_type_id_currency_id', '{{%character_money}}', 'currency_type_id', '{{%currency}}', 'id');
        $this->addForeignKey('character_money_character_id_character_id', '{{%character_money}}', 'character_id', '{{%character}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%character_money}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180325_140553_characterMoney cannot be reverted.\n";

        return false;
    }
    */
}
