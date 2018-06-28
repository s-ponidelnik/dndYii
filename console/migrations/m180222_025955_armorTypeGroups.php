<?php

use yii\db\Migration;

/**
 * Class m180222_025955_armorTypeGroups
 */
class m180222_025955_armorTypeGroups extends Migration
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
        $this->createTable('{{%armor_type_armor_rel}}', [
            'id' => $this->primaryKey()->unsigned(),
            'armor_id' => $this->integer()->unsigned(),
            'type_id' => $this->integer()->unsigned()
        ], $tableOptions);

        $this->addForeignKey('armor_type_armor_rel_armor_id_armor_id', '{{%armor_type_armor_rel}}', 'armor_id', '{{%armor}}', 'id');
        $this->addForeignKey('armor_type_armor_rel_type_id_armor_type_id', '{{%armor_type_armor_rel}}', 'type_id', '{{%armor_type}}', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%armor_type_armor_rel}}');
    }
}
