<?php

use yii\db\Migration;

/**
 * Class m180515_160353_characterUpdate
 */
class m180515_160353_characterUpdate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%character}}', 'icon_src', $this->string()->defaultValue(''));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%character}}', 'icon_src');
    }
}
