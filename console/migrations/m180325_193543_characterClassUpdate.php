<?php

use yii\db\Migration;

/**
 * Class m180325_193543_characterClassUpdate
 */
class m180325_193543_characterClassUpdate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%character_class}}', 'base_class', $this->boolean()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%character_class}}', 'base_class');
    }
}
