<?php

use yii\db\Migration;

/**
 * Class m180312_034020_race_update_2
 */
class m180312_034020_race_update_2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%race}}','speed',$this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%race}}','speed',$this->integer()->notNull());
    }
}
