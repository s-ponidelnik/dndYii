<?php

use yii\db\Migration;

/**
 * Class m180221_211010_skillUpdate
 */
class m180221_211010_skillUpdate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%class_skill_proficiency}}','group_id');
        $this->dropColumn('{{%class_skill_proficiency}}','type');
        $this->addColumn('{{%_class}}','class_skill_proficiency',$this->integer()->unsigned());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%class_skill_proficiency}}','type',$this->integer()->unsigned());
        $this->addColumn('{{%class_skill_proficiency}}','group_id',$this->integer()->unsigned());
        $this->dropColumn('{{%_class}}','class_skill_proficiency');
    }
}
