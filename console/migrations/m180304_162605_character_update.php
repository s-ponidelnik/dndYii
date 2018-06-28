<?php

use yii\db\Migration;

/**
 * Class m180304_162605_character_update
 */
class m180304_162605_character_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%character}}','max_hp',$this->integer()->unsigned());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%character}}','max_hp');
    }
}
