<?php

use yii\db\Migration;

/**
 * Class m180226_160158_classWeaponProficiency
 */
class m180226_160158_classWeaponProficiency extends Migration
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
        $this->createTable('{{%class_weapon_proficiency}}', [
            'id' => $this->primaryKey()->unsigned(),
            'weapon_type_id' => $this->integer()->unsigned(),
            'class_id' => $this->integer()->unsigned(),
        ], $tableOptions);
        $this->addForeignKey('class_weapon_proficiency_weapon_type_id_weapon_type_id', '{{%class_weapon_proficiency}}', 'weapon_type_id', '{{%weapon_type}}', 'id');
        $this->addForeignKey('class_weapon_proficiency_class_id_class_id', '{{%class_weapon_proficiency}}', 'class_id', '{{%_class}}', 'id');


        $this->createTable('{{%class_armor_proficiency}}', [
            'id' => $this->primaryKey()->unsigned(),
            'armor_type_id' => $this->integer()->unsigned(),
            'class_id' => $this->integer()->unsigned(),
        ], $tableOptions);
        $this->addForeignKey('class_armor_proficiency_armor_type_id_armor_type_id', '{{%class_armor_proficiency}}', 'armor_type_id', '{{%armor_type}}', 'id');
        $this->addForeignKey('class_armor_proficiency_class_id_class_id', '{{%class_armor_proficiency}}', 'class_id', '{{%_class}}', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%class_armor_proficiency}}');
        $this->dropTable('{{%class_weapon_proficiency}}');
    }
}
