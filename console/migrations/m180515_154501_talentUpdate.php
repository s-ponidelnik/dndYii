<?php

use yii\db\Migration;

/**
 * Class m180515_154501_talentUpdate
 */
class m180515_154501_talentUpdate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%talent}}','scalable',$this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%talent}}','scalable');
    }

}
