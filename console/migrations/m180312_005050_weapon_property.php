<?php

use yii\db\Migration;

/**
 * Class m180312_005050_weapon_property
 */
class m180312_005050_weapon_property extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%armor_property}}','weight');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%armor_property}}','weight',$this->float()->notNull());
    }
}
