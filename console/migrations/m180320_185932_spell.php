<?php

use yii\db\Migration;

/**
 * Class m180320_185932_spell
 */
class m180320_185932_spell extends Migration
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
        $this->createTable('{{%spell}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'level' => $this->integer()->unsigned(),
            'spell_property' => $this->string(),
            'overlay_time' => $this->integer()->unsigned(),
            'overlay_time_type' => $this->smallInteger()->notNull(),
            'distance' => $this->integer()->unsigned(),
            'components' => $this->string(),
            'duration_time' => $this->integer()->unsigned(),
            'duration_time_type' => $this->integer()->unsigned()->notNull(),
            'description' => $this->text()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%spell}}');
    }
}
