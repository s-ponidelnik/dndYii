<?php

use yii\db\Migration;

/**
 * Class m180222_034051_weaponNarmorTypesGroups
 */
class m180222_034051_weaponNarmorTypesGroups extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%armor_type}}', 'group', $this->boolean()->defaultValue(false));
        $this->addColumn('{{%weapon_type}}', 'group', $this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%weapon_type}}', 'group');
        $this->dropColumn('{{%armor_type}}', 'group');
    }
}
