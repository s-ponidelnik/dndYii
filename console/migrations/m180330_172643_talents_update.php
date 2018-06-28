<?php

use yii\db\Migration;

/**
 * Class m180330_172643_talents_update
 */
class m180330_172643_talents_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%talent}}', 'count', $this->integer());
        $this->addColumn('{{%talent}}', 'rest_condition', $this->smallInteger()->defaultValue(\common\models\Talent::FULL_REST));
        $this->addColumn('{{%character_talent}}', 'used', $this->integer()->defaultValue(0));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%character_talent}}', 'used');
        $this->dropColumn('{{talent}}', 'rest_condition');
        $this->dropColumn('{{talent}}', 'count');
    }
}
