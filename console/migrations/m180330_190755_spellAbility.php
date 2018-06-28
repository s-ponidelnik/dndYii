<?php

use yii\db\Migration;

/**
 * Class m180330_190755_spellAbility
 */
class m180330_190755_spellAbility extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%_class}}', 'spell_ability_id', $this->integer()->unsigned()->null());
        $this->addForeignKey('_class_spell_ability_id_ability_id','{{%_class}}','spell_ability_id','{{%ability}}','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('_class_spell_ability_id_ability_id','{{%_class}}');
        $this->dropColumn('{{%_class}}', 'spell_ability_id');
    }
}
