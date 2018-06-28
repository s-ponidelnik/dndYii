<?php

use yii\db\Migration;

/**
 * Class m180227_223643_talent_update
 */
class m180227_223643_talent_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%talent}}','property',$this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%talent}}','property');
    }
}
