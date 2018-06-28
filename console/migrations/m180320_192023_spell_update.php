<?php

use yii\db\Migration;

/**
 * Class m180320_192023_spell_update
 */
class m180320_192023_spell_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%spell}}', 'concentration', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%spell}}', 'concentration');
    }
}
