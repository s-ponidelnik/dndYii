<?php

use yii\db\Migration;

/**
 * Class m180222_013150_updateArmorTypes
 */
class m180222_013150_updateArmorTypes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%armor_type}}','additional_ac',$this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%armor_type}}','additional_ac');
    }
}
