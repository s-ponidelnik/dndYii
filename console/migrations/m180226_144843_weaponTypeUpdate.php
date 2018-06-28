<?php

use yii\db\Migration;

/**
 * Class m180226_144843_weaponTypeUpdate
 */
class m180226_144843_weaponTypeUpdate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%weapon_type}}','group');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%weapon_type}}', 'group', $this->boolean()->defaultValue(false));
    }
}
