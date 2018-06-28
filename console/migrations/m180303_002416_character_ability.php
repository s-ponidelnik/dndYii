<?php

use yii\db\Migration;

/**
 * Class m180303_002416_character_ability
 */
class m180303_002416_character_ability extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%character_ability}}','value',$this->integer()->unsigned());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%character_ability}}','value');
    }
}
