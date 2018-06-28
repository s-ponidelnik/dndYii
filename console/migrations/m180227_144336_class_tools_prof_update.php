<?php

use yii\db\Migration;

/**
 * Class m180227_144336_class_tools_prof_update
 */
class m180227_144336_class_tools_prof_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%class_tools_proficiency}}', 'count', $this->integer()->defaultValue(1)->notNull());
        $this->dropForeignKey('class_tools_proficiency_tools_id_tools_id', '{{%class_tools_proficiency}}');
        $this->dropColumn('{{%class_tools_proficiency}}', 'tools_id');
        $this->addColumn('{{%class_tools_proficiency}}', 'tools_object_id', $this->integer()->unsigned());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%class_tools_proficiency}}', 'tools_object_id');
        $this->dropColumn('{{%class_tools_proficiency}}', 'count');
        $this->addColumn('{{%class_tools_proficiency}}', 'tools_id', $this->integer()->unsigned());
        $this->addForeignKey('class_tools_proficiency_tools_id_tools_id', '{{%class_tools_proficiency}}', 'tools_id', '{{%tools}}', 'id');
    }
}
