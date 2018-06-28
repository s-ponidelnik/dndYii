<?php

use yii\db\Migration;

/**
 * Class m180303_000420_character_name
 */
class m180303_000420_character_name extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%character}}','name',$this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%character}}','name');
    }
}
