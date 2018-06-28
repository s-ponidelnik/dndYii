<?php

use yii\db\Migration;

/**
 * Class m180506_083547_update_CharacterTalent
 */
class m180506_083547_update_CharacterTalent extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%character_talent}}', 'used');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%character_talent}}', 'used', $this->integer()->unsigned());
    }

}
