<?php

use yii\db\Migration;

/**
 * Class m180302_221105_new
 */
class m180302_221105_character_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('character_race_id_race_id', '{{%character}}');
        $this->dropColumn('{{%character}}', 'sub_race_id');
        $this->addColumn('{{%character}}', 'hp', $this->integer());
        $this->dropColumn('{{%race}}', 'sub_race');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%race}}', 'sub_race', $this->boolean()->defaultValue(false));
        $this->dropColumn('{{%character}}', 'hp');
        $this->addColumn('{{%character}}', 'sub_race_id', $this->integer()->unsigned());
        $this->addForeignKey('character_race_id_race_id', '{{%character}}', 'race_id', '{{%race}}', 'id');
    }
}
