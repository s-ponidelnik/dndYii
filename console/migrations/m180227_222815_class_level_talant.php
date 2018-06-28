<?php

use yii\db\Migration;

/**
 * Class m180227_222815_class_level_talant
 */
class m180227_222815_class_level_talant extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%class_talent}}', 'level', $this->integer()->unsigned()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%class_talent}}', 'level');
    }
}
