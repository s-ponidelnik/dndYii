<?php

use yii\db\Migration;

/**
 * Class m180506_080627_class_talent_character_used
 */
class m180506_080627_class_talent_character_used extends Migration
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
        $this->createTable('{{%character_talent_used}}', [
            'id' => $this->primaryKey()->unsigned(),
            'character_id' => $this->integer()->unsigned(),
            'talent_id'=>$this->integer()->unsigned(),
            'used'=>$this->integer()->unsigned()->defaultValue(null),
        ], $tableOptions);
        $this->addForeignKey('character_talent_used_character_id_character_id','{{%character_talent_used}}','character_id','{{%character}}','id');
        $this->addForeignKey('character_talent_used_talent_id_talent_id','{{%character_talent_used}}','talent_id','{{%talent}}','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%character_talent_used}}');
    }
}
