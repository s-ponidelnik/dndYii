<?php

use yii\db\Migration;

/**
 * Class m180221_212501_fixRaceSkillProf
 */
class m180221_212501_fixRaceSkillProf extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%race_skill_proficiency}}','skill');
        $this->addColumn('{{%race_skill_proficiency}}','skill_id',$this->integer()->unsigned());
        $this->addForeignKey('race_skill_proficiency_skill_id_skill_id', '{{%race_skill_proficiency}}', 'skill_id', '{{%skill}}', 'id');

        $this->dropColumn('{{%race_skill_proficiency}}','type');
        $this->dropColumn('{{%race_skill_proficiency}}','group_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%race_skill_proficiency}}','group_id',$this->integer()->unsigned());
        $this->addColumn('{{%race_skill_proficiency}}','type',$this->integer()->unsigned());

        $this->addColumn('{{%race_skill_proficiency}}','skill',$this->integer()->unsigned());
        $this->dropColumn('{{%race_skill_proficiency}}','skill_id');
    }
}
