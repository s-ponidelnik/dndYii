<?php

use yii\db\Migration;

/**
 * Class m180221_212018_deleteClassSkillModifier
 */
class m180221_212018_deleteClassSkillModifier extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%class_skill_modifier}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%class_skill_modifier}}', [
            'id' => $this->primaryKey()->unsigned(),
            'skill_id' => $this->integer()->unsigned(),
            'modifier' => $this->integer(),
            'class_id' => $this->integer()->unsigned(),
            'group_id' => $this->integer()->unsigned(),
            'type' => $this->integer()->unsigned(),
        ], $tableOptions);

        $this->addForeignKey('class_skill_modifier_skill_id_skill_id', '{{%class_skill_modifier}}', 'skill_id', '{{%skill}}', 'id');
        $this->addForeignKey('class_skill_modifier_class_id_class_id', '{{%class_skill_modifier}}', 'class_id', '{{%_class}}', 'id');
    }
}
