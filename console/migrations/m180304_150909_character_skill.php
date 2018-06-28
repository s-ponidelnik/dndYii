<?php

use yii\db\Migration;

/**
 * Class m180304_150909_character_skill
 */
class m180304_150909_character_skill extends Migration
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

        $this->createTable('{{%character_skill}}', [
            'id' => $this->primaryKey()->unsigned(),
            'character_id' => $this->integer()->unsigned()->null(),
            'skill_id' => $this->integer()->unsigned()->null(),
            'proficiency'=>$this->boolean()->defaultValue(0),
            'expertise'=>$this->boolean()->defaultValue(0)
        ], $tableOptions);

        $this->addForeignKey('character_skill_character_id_character_id','{{%character_skill}}','character_id','{{%character}}','id');
        $this->addForeignKey('character_skill_skill_id_skill_id','{{%character_skill}}','skill_id','{{%skill}}','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%character_skill}}');
    }

}
