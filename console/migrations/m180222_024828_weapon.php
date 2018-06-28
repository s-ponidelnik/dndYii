<?php

use yii\db\Migration;

/**
 * Class m180222_024828_weapon
 */
class m180222_024828_weapon extends Migration
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
        $this->createTable('{{%weapon}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'cost' => $this->float()->null(),
            'currency_type_id' => $this->integer()->unsigned()->null(),
            'damage_dice' => $this->string()->notNull(),
            'two_hand_damage_dice' => $this->string()->null(),
            'weight' => $this->float()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('weapon_currency_type_id_currency_id', '{{%weapon}}', 'currency_type_id', '{{%currency}}', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%weapon}}');
    }
}
