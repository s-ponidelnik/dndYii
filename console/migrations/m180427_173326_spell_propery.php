<?php

use yii\db\Migration;

/**
 * Class m180427_173326_spell_propery
 */
class m180427_173326_spell_propery extends Migration
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
        $this->createTable('{{%spell_school}}', [
            'id' => $this->primaryKey()->unsigned(),
            'spell_school' => $this->string(),
        ], $tableOptions);

        $this->dropColumn('{{%spell_school}}', 'spell_school');
        $this->addColumn('{{%spell}}', 'spell_school_id', $this->integer()->unsigned());
        $this->addForeignKey('spell_spell_school_spell_school_id_spell_school_id', '{{%spell}}', 'spell_school_id', '{{%spell_school}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%spell_school}}');
        $this->addColumn('{{%spell}}', 'spell_property', $this->string());
        $this->dropColumn('{{%spell}}', 'spell_school_id');
    }
}
