<?php

use yii\db\Migration;

/**
 * Class m180222_002004_createCurrency
 */
class m180222_002004_createCurrency extends Migration
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
        $this->createTable('{{%currency}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'short_name' => $this->string(2)->notNull(),
            'value_weight' => $this->float()->notNull()
        ], $tableOptions);

        $this->addForeignKey('armor_currency_type_id_currency_id', '{{%armor}}', 'currency_type_id', '{{%currency}}', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('armor_currency_type_id_currency_id','{{%armor}}');
        $this->dropTable('{{%currency}}');
    }


}
