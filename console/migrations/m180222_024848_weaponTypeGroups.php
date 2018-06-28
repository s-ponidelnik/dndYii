<?php

use yii\db\Migration;

/**
 * Class m180222_024848_weaponTypeGroups
 */
class m180222_024848_weaponTypeGroups extends Migration
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
        $this->createTable('{{%weapon_type_weapon_rel}}', [
            'id' => $this->primaryKey()->unsigned(),
            'weapon_id' => $this->integer()->unsigned(),
            'type_id' => $this->integer()->unsigned()
        ], $tableOptions);
        
        $this->addForeignKey('weapon_type_weapon_rel_weapon_id_weapon_id', '{{%weapon_type_weapon_rel}}', 'weapon_id', '{{%weapon}}', 'id');
        $this->addForeignKey('weapon_type_weapon_rel_type_id_weapon_type_id', '{{%weapon_type_weapon_rel}}', 'type_id', '{{%weapon_type}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%weapon_type_weapon_rel}}');
    }
}
