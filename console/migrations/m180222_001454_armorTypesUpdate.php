<?php

use yii\db\Migration;

/**
 * Class m180222_001454_armorTypesUpdate
 */
class m180222_001454_armorTypesUpdate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%armor_type}}', 'don', $this->smallInteger()->unsigned()->null());
        $this->addColumn('{{%armor_type}}', 'don_time_type', $this->smallInteger()->unsigned());
        $this->addColumn('{{%armor_type}}', 'doff', $this->smallInteger()->unsigned()->null());
        $this->addColumn('{{%armor_type}}', 'doff_time_type', $this->smallInteger()->unsigned());
        $this->addColumn('{{%armor_type}}', 'desc', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%armor_type}}', 'don');
        $this->dropColumn('{{%armor_type}}', 'doff');
        $this->dropColumn('{{%armor_type}}', 'doff_time_type');
        $this->dropColumn('{{%armor_type}}', 'don_time_type');
        $this->dropColumn('{{%armor_type}}', 'desc');
    }
}
