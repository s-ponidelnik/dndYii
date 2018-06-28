<?php

use yii\db\Migration;

/**
 * Class m180221_195940_RaceUpdate
 */
class m180221_195940_RaceUpdate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%race}}','speed',$this->integer()->notNull());
        $this->addColumn('{{%race}}','ideology',$this->text()->null());
        $this->addColumn('{{%race}}','age',$this->text()->null());
        $this->addColumn('{{%race}}','size',$this->text()->null());
        $this->addColumn('{{%race}}','names',$this->text()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%race}}','speed');
        $this->dropColumn('{{%race}}','ideology');
        $this->dropColumn('{{%race}}','age');
        $this->dropColumn('{{%race}}','size');
        $this->dropColumn('{{%race}}','names');
    }
}
