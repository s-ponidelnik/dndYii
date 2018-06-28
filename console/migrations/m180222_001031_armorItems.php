<?php

use yii\db\Migration;

/**
 * Class m180222_001031_armorItems
 */
class m180222_001031_armorItems extends Migration
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

        $this->createTable('{{%armor}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'type_id' => $this->integer()->unsigned(),
            'cost' => $this->float()->unsigned()->null(),
            'currency_type_id' => $this->integer()->unsigned()->null(),
            'ac' => $this->integer()->unsigned(),
            'str' => $this->integer()->unsigned(),
            'stealth_disadvantage' => $this->boolean(),
            'weight' => $this->float()->notNull(),
            'dex_mod' => $this->boolean()->defaultValue(true),
            'dex_mod_limit' => $this->smallInteger()->defaultValue(-1),
        ], $tableOptions);

        $this->addForeignKey('armor_type_id_armor_type_id', '{{%armor}}', 'type_id', '{{%armor_type}}', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%armor}}');
    }
}
