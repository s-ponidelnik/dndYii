<?php

use yii\db\Migration;

/**
 * Class m180325_151444_weaponUpdate
 */
class m180325_151444_weaponUpdate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%weapon_property}}', 'attack_bonus', $this->integer()->null());
        $this->addColumn('{{%weapon_property}}', 'damage_bonus', $this->integer()->null());
        $this->addColumn('{{%weapon_property}}', 'fit', $this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%weapon_property}}', 'fit');
        $this->dropColumn('{{%weapon_property}}', 'damage_bonus');
        $this->dropColumn('{{%weapon_property}}', 'attack_bonus');
    }
}
