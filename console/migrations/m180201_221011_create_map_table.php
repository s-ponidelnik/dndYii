<?php

use yii\db\Migration;

/**
 * Handles the creation of table `map`.
 */
class m180201_221011_create_map_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%map}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255)->notNull(),
            'description'=>$this->text()->null(),
            'img_name'=>$this->string(255)->null(),
            'type'=>$this->smallInteger()->notNull(),
            'owner_id'=>$this->integer(11)->notNull()
        ],$tableOptions);
        $this->addForeignKey('map_owner_id_user_id','{{%map}}','owner_id','{{%user}}','id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('map_owner_id_user_id','{{%map}}');
        $this->dropTable('{{%map}}');
    }
}
