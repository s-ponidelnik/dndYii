<?php

use yii\db\Migration;

/**
 * Class m180325_175437_itemsUpdate
 */
class m180325_175437_itemsUpdate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%items}}','packable',$this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%items}}','packable');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180325_175437_itemsUpdate cannot be reverted.\n";

        return false;
    }
    */
}
