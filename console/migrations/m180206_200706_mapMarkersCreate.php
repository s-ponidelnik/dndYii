<?php

use yii\db\Migration;

/**
 * Class m180206_200706_mapMarkersCreate
 */
class m180206_200706_mapMarkersCreate extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%map_markers}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255)->notNull(),
            'description'=>$this->text()->null(),
            'img_name'=>$this->string(255)->null(),
            'pos_x'=>$this->integer()->notNull(),
            'pos_y'=>$this->integer()->notNull(),
            'type'=>$this->smallInteger()->notNull(),
            'sub_map_id'=>$this->integer(11)->null(),
            'map_id'=>$this->integer(11)->notNull()
        ],$tableOptions);
        $this->addForeignKey('map_maker_map_id_map_id','{{%map_markers}}','map_id','{{%map}}','id');
        $this->addForeignKey('map_maker_sub_map_id_map_id','{{%map_markers}}','sub_map_id','{{%map}}','id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('map_maker_sub_map_id_map_id','{{%map_markers}}');
        $this->dropForeignKey('map_maker_map_id_map_id','{{%map_markers}}');
        $this->dropTable('{{%map_markers}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180206_200706_mapMarkersCreate cannot be reverted.\n";

        return false;
    }
    */
}
