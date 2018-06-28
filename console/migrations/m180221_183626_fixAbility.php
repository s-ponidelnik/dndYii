<?php

use yii\db\Migration;

/**
 * Class m180221_183626_fixAbility
 */
class m180221_183626_fixAbility extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%ability}}','name');
        $this->addColumn('{{%ability}}','name',$this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ability}}','name');
        $this->addColumn('{{%ability}}','name',$this->integer()->unsigned());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180221_183626_fixAbility cannot be reverted.\n";

        return false;
    }
    */
}
