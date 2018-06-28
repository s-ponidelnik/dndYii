<?php

use yii\db\Migration;

/**
 * Class m180227_130106_class_tools_prof
 */
class m180227_130106_class_tools_prof extends Migration
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
        $this->createTable('{{%class_tools_proficiency}}', [
            'id' => $this->primaryKey()->unsigned(),
            'tools_id' => $this->integer()->unsigned(),
            'class_id' => $this->integer()->unsigned(),
        ], $tableOptions);
        $this->addForeignKey('class_tools_proficiency_tools_id_tools_id', '{{%class_tools_proficiency}}', 'tools_id', '{{%tools}}', 'id');
        $this->addForeignKey('class_tools_proficiency_class_id_class_id', '{{%class_tools_proficiency}}', 'class_id', '{{%_class}}', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%class_tools_proficiency}}');
    }
}
