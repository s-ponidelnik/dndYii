<?php

use yii\db\Migration;

/**
 * Class m180222_023630_updateWeaponType
 */
class m180222_023630_updateWeaponType extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%weapon_type}}', 'parent_type_id', $this->integer()->unsigned());
        $this->addForeignKey('weapon_type_parent_type_id_weapon_type_id', '{{%weapon_type}}', 'parent_type_id', '{{%weapon_type}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('weapon_type_parent_type_id_weapon_type_id', '{{%weapon_type}}');
        $this->dropColumn('{{%weapon_type}}', 'parent_type_id');
    }
}
