<?php

use yii\db\Migration;

/**
 * Class m180312_033410_race_update
 */
class m180312_033410_race_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%race}}','playable',$this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{$race}}','playable');
    }
}
