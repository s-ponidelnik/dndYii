<?php

use yii\db\Migration;

/**
 * Class m180221_225154_classUpdate
 */
class m180221_225154_classUpdate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%_class}}','hit_dice',$this->string()->notNull());
        $this->addColumn('{{%_class}}','first_level_hit_points',$this->integer()->unsigned()->notNull());
        $this->addColumn('{{%_class}}','hit_points_per_level',$this->string()->notNull());
        $this->addColumn('{{%_class}}','hit_points_per_level_stable',$this->integer()->notNull());

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%class_saving_throws}}', [
            'id' => $this->primaryKey()->unsigned(),
            'class_id' => $this->integer()->unsigned(),
            'ability_id' => $this->integer()->unsigned()
        ], $tableOptions);

        $this->addForeignKey('class_saving_throws_ability_id_ability_id', '{{%class_saving_throws}}', 'ability_id', '{{%ability}}', 'id');
        $this->addForeignKey('class_saving_throws_class_id_class_id', '{{%class_saving_throws}}', 'class_id', '{{%_class}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%class_saving_throws}}');

        $this->dropColumn('{{%_class}}','hit_dice');
        $this->dropColumn('{{%_class}}','first_level_hit_points');
        $this->dropColumn('{{%_class}}','hit_points_per_level');
        $this->dropColumn('{{%_class}}','hit_points_per_level_stable');
    }
}
