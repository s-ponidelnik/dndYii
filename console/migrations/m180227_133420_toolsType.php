<?php

use yii\db\Migration;

/**
 * Class m180227_133420_toolsType
 */
class m180227_133420_toolsType extends Migration
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
        $this->createTable('{{%tools_type}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'desc' => $this->text()->null(),
            'short_desc' => $this->text()->null()
        ], $tableOptions);
        $this->addColumn('{{%tools}}', 'type_id', $this->integer()->unsigned()->null());
        $this->addForeignKey('tools_type_id_tools_type_id', '{{%tools}}', 'type_id', '{{%tools_type}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('tools_type_id_tools_type_id', '{{%tools}}');
        $this->dropColumn('{{%tools}}', 'type_id');
        $this->dropTable('{{%tools_type}}');
    }


}
