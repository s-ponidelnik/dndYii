<?php

use yii\db\Migration;

/**
 * Class m180221_141501_character
 */
class m180221_141501_character extends Migration
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

        $this->createTable('{{%ability}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->integer()->unsigned(),
            'desc' => $this->text()
        ], $tableOptions);

        $this->createTable('{{%skill}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->integer()->unsigned(),
            'ability_id' => $this->integer()->unsigned(),
            'desc' => $this->text()
        ], $tableOptions);

        $this->addForeignKey('skill_ability_id_ability_id', '{{%skill}}', 'ability_id', '{{%ability}}', 'id');


        $this->createTable('{{%race}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'parent_id' => $this->integer()->unsigned(),
            'sub_race' => $this->boolean()->defaultValue(false)
        ], $tableOptions);

        $this->addForeignKey('race_parent_id_race_id', '{{%race}}', 'parent_id', '{{%race}}', 'id');

        $this->createTable('{{%race_ability_modifier}}', [
            'id' => $this->primaryKey()->unsigned(),
            'ability_id' => $this->integer()->unsigned(),
            'modifier' => $this->integer(),
            'race_id' => $this->integer()->unsigned(),
        ], $tableOptions);

        $this->addForeignKey('race_ability_modifier_race_id_race_id', '{{%race_ability_modifier}}', 'race_id', '{{%race}}', 'id');
        $this->addForeignKey('race_ability_modifier_ability_id_ability_id', '{{%race_ability_modifier}}', 'ability_id', '{{%ability}}', 'id');


        $this->createTable('{{%_class}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(),
            'archetype' => $this->boolean()->defaultValue(false),
            'parent_id' => $this->integer()->unsigned()->defaultValue(null),
            'magic_proficiency_type' => $this->integer()->unsigned()->defaultValue(null),
        ], $tableOptions);

        $this->addForeignKey('class_parent_id_class_id', '{{%_class}}', 'parent_id', '{{%_class}}', 'id');


        $this->createTable('{{%class_skill_modifier}}', [
            'id' => $this->primaryKey()->unsigned(),
            'skill_id' => $this->integer()->unsigned(),
            'modifier' => $this->integer(),
            'class_id' => $this->integer()->unsigned(),
            'group_id' => $this->integer()->unsigned(),
            'type' => $this->integer()->unsigned(),
        ], $tableOptions);

        $this->addForeignKey('class_skill_modifier_skill_id_skill_id', '{{%class_skill_modifier}}', 'skill_id', '{{%skill}}', 'id');
        $this->addForeignKey('class_skill_modifier_class_id_class_id', '{{%class_skill_modifier}}', 'class_id', '{{%_class}}', 'id');


        $this->createTable('{{%class_skill_proficiency}}', [
            'id' => $this->primaryKey()->unsigned(),
            'skill_id' => $this->integer()->unsigned(),
            'class_id' => $this->integer()->unsigned(),
            'group_id' => $this->integer()->unsigned(),
            'type' => $this->integer()->unsigned(),
        ], $tableOptions);
        $this->addForeignKey('class_skill_proficiency_skill_id', '{{%class_skill_proficiency}}', 'skill_id', '{{%skill}}', 'id');
        $this->addForeignKey('class_skill_proficiency_class_id_class_id', '{{%class_skill_proficiency}}', 'class_id', '{{%_class}}', 'id');


        $this->createTable('{{%talent}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(),
            'description' => $this->text(),
        ], $tableOptions);


        $this->createTable('{{%race_talent}}', [
            'id' => $this->primaryKey()->unsigned(),
            'race_id' => $this->integer()->unsigned(),
            'talent_id' => $this->integer()->unsigned(),
        ], $tableOptions);

        $this->addForeignKey('race_talent_race_id_race_id', '{{%race_talent}}', 'race_id', '{{%race}}', 'id');
        $this->addForeignKey('race_talent_talent_id_talent_id', '{{%race_talent}}', 'talent_id', '{{%talent}}', 'id');


        $this->createTable('{{%class_talent}}', [
            'id' => $this->primaryKey()->unsigned(),
            'class_id' => $this->integer()->unsigned(),
            'talent_id' => $this->integer()->unsigned(),
        ], $tableOptions);

        $this->addForeignKey('class_talent_class_id_class_id', '{{%class_talent}}', 'class_id', '{{%_class}}', 'id');
        $this->addForeignKey('class_talent_talent_id_talent_id', '{{%class_talent}}', 'talent_id', '{{%talent}}', 'id');


        $this->createTable('{{%character}}', [
            'id' => $this->primaryKey()->unsigned(),
            'race_id' => $this->integer()->unsigned(),
            'sub_race_id' => $this->integer()->unsigned(),
            'exp' => $this->integer()->unsigned(),
        ], $tableOptions);

        $this->addForeignKey('character_race_id_race_id', '{{%character}}', 'race_id', '{{%race}}', 'id');

        $this->createTable('{{%character_class}}', [
            'id' => $this->primaryKey()->unsigned(),
            'character_id' => $this->integer()->unsigned(),
            'class_id' => $this->integer()->unsigned(),
            'level' => $this->integer()->unsigned()
        ], $tableOptions);

        $this->addForeignKey('character_class_character_id_character_id', '{{%character_class}}', 'character_id', '{{%character}}', 'id');
        $this->addForeignKey('character_class_class_id_class_id', '{{%character_class}}', 'class_id', '{{%_class}}', 'id');


        $this->createTable('{{%class_magic_point}}', [
            'id' => $this->primaryKey()->unsigned(),
            'spell_point' => $this->integer()->unsigned(),
            'level' => $this->integer()->unsigned(),
            'class_id' => $this->integer()->unsigned(),
        ], $tableOptions);

        $this->addForeignKey('class_magic_point_class_id_class_id', '{{%class_magic_point}}', 'class_id', '{{%_class}}', 'id');


        $this->createTable('{{%class_magic_level_point}}', [
            'id' => $this->primaryKey()->unsigned(),
            'spell_level' => $this->integer()->unsigned(),
            'spell_point' => $this->integer()->unsigned(),
            'level' => $this->integer()->unsigned(),
            'class_id' => $this->integer()->unsigned(),
        ], $tableOptions);

        $this->addForeignKey('class_magic_level_point_class_id_class_id', '{{%class_magic_level_point}}', 'class_id', '{{%_class}}', 'id');

        $this->createTable('{{%character_ability}}', [
            'id' => $this->primaryKey()->unsigned(),
            'character_id' => $this->integer()->unsigned(),
            'ability_id' => $this->integer()->unsigned(),
        ], $tableOptions);

        $this->addForeignKey('character_ability_id_ability_id', '{{%skill}}', 'ability_id', '{{%ability}}', 'id');
        $this->addForeignKey('character_ability_character_id_character_id', '{{%character_ability}}', 'character_id', '{{%character}}', 'id');


        $this->createTable('{{%race_skill_proficiency}}', [
            'id' => $this->primaryKey()->unsigned(),
            'skill' => $this->integer()->unsigned(),
            'race_id' => $this->integer()->unsigned(),
            'group_id' => $this->integer()->unsigned(),
            'type' => $this->integer()->unsigned(),
        ], $tableOptions);

        $this->addForeignKey('race_skill_proficiency_race_id_race_id', '{{%race_skill_proficiency}}', 'race_id', '{{%race}}', 'id');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%race_skill_proficiency}}');
        $this->dropTable('{{%character_ability}}');
        $this->dropTable('{{%class_magic_level_point}}');
        $this->dropTable('{{%class_magic_point}}');
        $this->dropTable('{{%character_class}}');
        $this->dropTable('{{%character}}');
        $this->dropTable('{{%class_talent}}');
        $this->dropTable('{{%race_talent}}');
        $this->dropTable('{{%talent}}');
        $this->dropTable('{{%class_skill_proficiency}}');
        $this->dropTable('{{%class_skill_modifier}}');
        $this->dropTable('{{%_class}}');
        $this->dropTable('{{%race_ability_modifier}}');
        $this->dropTable('{{%race}}');
        $this->dropTable('{{%skill}}');
        $this->dropTable('{{%ability}}');
    }
}
