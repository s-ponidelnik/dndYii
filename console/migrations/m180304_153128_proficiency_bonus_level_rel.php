<?php

use yii\db\Migration;

/**
 * Class m180304_153128_proficiency_bonus_level_rel
 */
class m180304_153128_proficiency_bonus_level_rel extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%proficiency_bonus_level_rel}}', [
            'id' => $this->primaryKey()->unsigned(),
            'proficiency_bonus' => $this->integer()->unsigned()->notNull(),
            'level' => $this->integer()->unsigned()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%proficiency_bonus_level_rel}}');
    }
}
