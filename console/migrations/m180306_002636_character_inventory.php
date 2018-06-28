<?php

use yii\db\Migration;

/**
 * Class m180306_002636_character_inventory
 */
class m180306_002636_character_inventory extends Migration
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


        $this->createTable('{{%items}}', [
            'id' => $this->primaryKey()->unsigned(),
            'item_type' => $this->smallInteger()->unsigned(),
            'name' => $this->string(255)->notNull(),
            'cost' => $this->float()->null(),
            'currency_type_id' => $this->integer()->unsigned()->null(),
            'weight' => $this->float()->null(),
            'description' => $this->text(),
            'short_description' => $this->text()
        ], $tableOptions);

        $this->addForeignKey('items_currency_type_id_currency_id', '{{%items}}', 'currency_type_id', '{{%currency}}', 'id');


        /*armor_property property*/
        $this->createTable('{{%armor_property}}', [
            'id' => $this->primaryKey()->unsigned(),
            'item_id' => $this->integer()->unsigned(),
            'type_id' => $this->integer()->unsigned(),
            'ac' => $this->integer()->unsigned(),
            'str' => $this->integer()->unsigned(),
            'stealth_disadvantage' => $this->boolean(),
            'weight' => $this->float()->notNull(),
            'dex_mod' => $this->boolean()->defaultValue(true),
            'dex_mod_limit' => $this->smallInteger()->defaultValue(-1),
        ], $tableOptions);
        $this->addForeignKey('armor_type_id_armor_type_id', '{{%armor}}', 'type_id', '{{%armor_type}}', 'id');
        $this->addForeignKey('armor_property_item_id_items_id', '{{%armor_property}}', 'item_id', '{{%items}}', 'id');


        $this->dropForeignKey('armor_type_armor_rel_armor_id_armor_id', '{{%armor_type_armor_rel}}');
        $this->dropColumn('{{%armor_type_armor_rel}}', 'armor_id');
        $this->addColumn('{{%armor_type_armor_rel}}', 'item_id', $this->integer()->unsigned());
        $this->addForeignKey('armor_type_armor_rel_item_id_items_id', '{{%armor_type_armor_rel}}', 'item_id', '{{%items}}', 'id');


        $this->createTable('{{%weapon_property}}', [
            'id' => $this->primaryKey()->unsigned(),
            'item_id' => $this->integer()->unsigned(),
            'damage_dice' => $this->string()->notNull(),
            'two_hand_damage_dice' => $this->string()->null(),
        ], $tableOptions);
        $this->addForeignKey('weapon_property_item_id_items_id', '{{%weapon_property}}', 'item_id', '{{%items}}', 'id');


        $this->dropForeignKey('weapon_type_weapon_rel_weapon_id_weapon_id', '{{%weapon_type_weapon_rel}}');
        $this->dropColumn('{{%weapon_type_weapon_rel}}', 'weapon_id');
        $this->addColumn('{{%weapon_type_weapon_rel}}', 'item_id', $this->integer()->unsigned());
        $this->addForeignKey('weapon_type_weapon_rel_item_id_items_id', '{{%weapon_type_weapon_rel}}', 'item_id', '{{%items}}', 'id');


        $this->createTable('{{%character_items}}', [
            'id' => $this->primaryKey()->unsigned(),
            'character_id' => $this->integer()->unsigned(),
            'item_id' => $this->integer()->unsigned(),
            'count' => $this->smallInteger()->unsigned(),
            'equip' => $this->boolean()->defaultValue(0)
        ], $tableOptions);

        $this->addForeignKey('character_items_item_id_items_id', '{{%character_items}}', 'item_id', '{{%items}}', 'id');
        $this->addForeignKey('character_items_character_id_character_id', '{{%character_items}}', 'character_id', '{{%character}}', 'id');

        $this->dropForeignKey('weapon_property_weapon_id', '{{%weapon_properties}}');
        $this->dropColumn('{{%weapon_properties}}','weapon_id');
        $this->addColumn('{{%weapon_properties}}','item_id',$this->integer()->unsigned());
        $this->addForeignKey('weapon_properties_item_id_items_id', '{{%weapon_properties}}', 'item_id', '{{%items}}', 'id');



        $this->dropTable('{{%armor}}');
        $this->dropTable('{{%weapon}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%weapon}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'cost' => $this->float()->null(),
            'currency_type_id' => $this->integer()->unsigned()->null(),
            'damage_dice' => $this->string()->notNull(),
            'two_hand_damage_dice' => $this->string()->null(),
            'weight' => $this->float()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('weapon_currency_type_id_currency_id', '{{%weapon}}', 'currency_type_id', '{{%currency}}', 'id');

        $this->createTable('{{%armor}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'type_id' => $this->integer()->unsigned(),
            'cost' => $this->float()->unsigned()->null(),
            'currency_type_id' => $this->integer()->unsigned()->null(),
            'ac' => $this->integer()->unsigned(),
            'str' => $this->integer()->unsigned(),
            'stealth_disadvantage' => $this->boolean(),
            'weight' => $this->float()->notNull(),
            'dex_mod' => $this->boolean()->defaultValue(true),
            'dex_mod_limit' => $this->smallInteger()->defaultValue(-1),
        ], $tableOptions);

        $this->addForeignKey('armor_type_id_armor_type_id', '{{%armor}}', 'type_id', '{{%armor_type}}', 'id');

        $this->dropTable('{{%character_items}}');
        $this->dropTable('{{%weapon_property}}');
        $this->dropTable('{{%armor_property}}');
        $this->dropTable('{{%items}}');
    }
}
