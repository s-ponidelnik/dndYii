<?php

use yii\db\Migration;

/**
 * Class m180427_174220_spell_school_update
 */
class m180427_174220_spell_school_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%spell_school}}', 'name', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%spell_school}}', 'name');

        return false;
    }
}
