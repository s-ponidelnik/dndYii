<?php

use yii\db\Migration;

/**
 * Class m180328_010802_multiclass_magic_level_point
 */
class m180328_010802_multiclass_magic_level_point extends Migration
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
        $this->createTable('{{%multiclass_magic_level_point}}', [
            'id' => $this->primaryKey()->unsigned(),
            'spell_level' => $this->integer()->unsigned(),
            'spell_point' => $this->integer()->unsigned(),
            'level' => $this->integer()->unsigned(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{multiclass_magic_level_point}}');
    }
}
