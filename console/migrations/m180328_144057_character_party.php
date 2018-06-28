<?php

use yii\db\Migration;

/**
 * Class m180328_144057_character_party
 */
class m180328_144057_character_party extends Migration
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

        $this->createTable('{{%character_party}}', [
            'id' => $this->primaryKey()->unsigned(),
            'character_id' => $this->integer()->unsigned(),
            'party_identifier' => $this->string(255)->notNull(),
            'party_leader' => $this->boolean()->defaultValue(0)
        ], $tableOptions);
        $this->addForeignKey('character_party_character_id_character_id', '{{%character_party}}', 'character_id', '{{%character}}', 'id');
        $this->createIndex('unique_character_party_leader', '{{%character_party}}', ['character_id', 'party_identifier', 'party_leader'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('unique_character_party_leader', '{{%character_party}}');
        $this->dropForeignKey('character_party_character_id_character_id', '{{%character_party}}');
        $this->dropTable('{{%character_party}}');
    }
}
