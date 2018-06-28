<?php

use yii\db\Migration;

/**
 * Class m180221_203416_skillFix
 */
class m180221_203416_skillFix extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%skill}}','name');
        $this->addColumn('{{%skill}}','name',$this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%skill}}','name');
        $this->addColumn('{{%skill}}','name',$this->integer()->unsigned());
    }
}
