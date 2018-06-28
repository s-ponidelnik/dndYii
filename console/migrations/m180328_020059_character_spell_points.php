<?php

use yii\db\Migration;

/**
 * Class m180328_020059_character_spell_points
 */
class m180328_020059_character_spell_points extends Migration
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
        $this->createTable('{{%character_spell_points}}', [
            'id' => $this->primaryKey()->unsigned(),
            'character_id' => $this->integer()->unsigned(),
            'spell_level' => $this->integer()->unsigned(),
            'spell_point' => $this->integer()->unsigned(),
        ], $tableOptions);
        $this->addForeignKey('character_spell_points_character_id_character_id', '{{%character_spell_points}}', 'character_id', '{{%character}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('character_spell_points_character_id_character_id', '{{%character_spell_points}}');
        $this->dropTable('{{%character_spell_points}}');
    }
}
