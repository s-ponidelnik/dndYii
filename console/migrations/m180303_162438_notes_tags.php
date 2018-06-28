<?php

use yii\db\Migration;

/**
 * Class m180303_162438_notes_tags
 */
class m180303_162438_notes_tags extends Migration
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

        $this->createTable('{{%note_tags}}', [
            'id' => $this->primaryKey()->unsigned(),
            'note_id' => $this->integer()->unsigned()->null(),
            'tag_id' => $this->integer()->unsigned()->null()
        ], $tableOptions);

        $this->addForeignKey('note_tags_note_id_note_id', '{{%note_tags}}', 'note_id', '{{%notes}}', 'id');
        $this->addForeignKey('note_tags_tag_id_tags_id', '{{%note_tags}}', 'tag_id', '{{%tags}}', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%note_tags}}');
    }
}
