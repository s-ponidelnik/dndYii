<?php

use yii\db\Migration;

/**
 * Class m180328_142243_character_update_player_id
 */
class m180328_142243_character_update_player_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%character}}', 'player_id', $this->integer());
        $this->addForeignKey('character_player_id_user_id', '{{%character}}', 'player_id', '{{%user}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('character_player_id_user_id', '{{%character}}');
        $this->dropColumn('{{%character}}', 'player_id');
    }
}
