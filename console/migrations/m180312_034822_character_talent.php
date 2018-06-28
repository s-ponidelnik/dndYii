<?php

use yii\db\Migration;

/**
 * Class m180312_034822_character_talent
 */
class m180312_034822_character_talent extends Migration
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
        $this->createTable('{{%character_talent}}', [
            'id' => $this->primaryKey()->unsigned(),
            'character_id' => $this->integer()->unsigned(),
            'talent_id' => $this->integer()->unsigned(),
        ], $tableOptions);
        $this->addForeignKey('character_talent_character_id_character_id', '{{%character_talent}}', 'character_id', '{{%character}}', 'id');
        $this->addForeignKey('character_talent_talent_id_talent_id', '{{%character_talent}}', 'talent_id', '{{%talent}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%character_talent}}');
    }

}
