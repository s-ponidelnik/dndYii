<?php

use yii\db\Migration;

/**
 * Class m180328_013215_update_classes_by_caster_value
 */
class m180328_013215_update_classes_by_caster_value extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%_class}}','caster_value',$this->float()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%_class}}','caster_value');
    }
}
