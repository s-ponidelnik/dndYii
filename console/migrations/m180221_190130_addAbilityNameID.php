<?php

use yii\db\Migration;

/**
 * Class m180221_190130_addAbilityNameID
 */
class m180221_190130_addAbilityNameID extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ability}}','nameID',$this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ability}}','nameID');
    }

}
