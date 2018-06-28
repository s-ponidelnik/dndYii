<?php

use yii\db\Migration;

/**
 * Class m180303_160656_notes
 */
class m180303_160656_notes extends Migration
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
        $this->createTable('{{%notes}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'note' => $this->text()->notNull(),
            'parent_id'=>$this->integer()->unsigned()->null(),
            'map_id' => $this->integer()->null()
        ], $tableOptions);

        $this->addForeignKey('notes_map_id_map_id', '{{%notes}}', 'map_id', '{{%map}}', 'id');
        $this->addForeignKey('notes_parent_id_notes_id', '{{%notes}}', 'parent_id', '{{%notes}}', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notes}}');
    }
}
