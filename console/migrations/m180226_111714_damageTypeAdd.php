<?php

use yii\db\Migration;

/**
 * Class m180226_111714_damageTypeAdd
 */
class m180226_111714_damageTypeAdd extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%weapon}}', 'damage_type', $this->smallInteger()->notNull());
        $this->dropColumn('{{%weapon}}', 'two_hand_damage_dice');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%weapon}}', 'two_hand_damage_dice', $this->string()->null());
        $this->dropColumn('{{%weapon}}', 'damage_type');
    }


}
