<?php

use yii\db\Migration;

/**
 * Class m180227_130049_tools
 */
class m180227_130049_tools extends Migration
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
        $this->createTable('{{%tools}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'desc' => $this->text()->null(),
            'short_desc' => $this->text()->null(),
            'cost' => $this->float()->null(),
            'currency_type_id' => $this->integer()->unsigned()->null(),
            'weight' => $this->float()->null(),
        ], $tableOptions);

        $this->addForeignKey('tools_currency_type_id_currency_id', '{{%tools}}', 'currency_type_id', '{{%currency}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tools}}');
    }

}
