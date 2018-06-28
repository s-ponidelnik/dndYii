<?php

use yii\db\Migration;

/**
 * Class m180221_194643_addRaceInfo
 */
class m180221_194643_addRaceInfo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%race}}','info',$this->text()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%race}}','info');
    }
}
