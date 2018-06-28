<?php

use yii\db\Migration;

/**
 * Class m180221_233826_weaponType
 */
class m180221_233826_weaponType extends Migration
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

        $this->createTable('{{%weapon_type}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%weapon_type}}');
    }
}
