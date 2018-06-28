<?php

use yii\db\Migration;

/**
 * Class m180222_024840_weaponProperties
 */
class m180222_024840_weaponProperties extends Migration
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
        $this->createTable('{{%weapon_properties}}', [
            'id' => $this->primaryKey()->unsigned(),
            'weapon_id' => $this->integer()->unsigned(),
            'property' => $this->smallInteger()->unsigned()->notNull(),
            'property_value' => $this->string()->null(),
        ], $tableOptions);

        $this->addForeignKey('weapon_property_weapon_id', '{{%weapon_properties}}', 'weapon_id', '{{%weapon}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%weapon_properties}}');
    }
}
