<?php

use yii\db\Migration;

/**
 * Class m180325_141533_updateCurrency
 */
class m180325_141533_updateCurrency extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{currency}}','weight',$this->float()->unsigned());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{currency}}','weight');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180325_141533_updateCurrency cannot be reverted.\n";

        return false;
    }
    */
}
