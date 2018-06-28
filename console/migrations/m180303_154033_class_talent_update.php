<?php

use yii\db\Migration;

/**
 * Class m180303_154033_class_talent_update
 */
class m180303_154033_class_talent_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%talent}}','property');
        $this->addColumn('{{%class_talent}}','property',$this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%class_talent}}','property');
        $this->addColumn('{{%talent}}','property',$this->string()->null());
    }
}
