<?php

use yii\db\Migration;

/**
 * Class m180325_143715_characterItemsUpdate
 */
class m180325_143715_characterItemsUpdate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%character_items}}', 'sub_item_id', $this->integer()->unsigned()->null());
        $this->addForeignKey('character_items_sub_item_id_character_items_id', '{{%character_items}}',
            'sub_item_id', '{{%character_items}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('character_items_sub_item_id_character_items_id', '{{%character_items}}');
        $this->dropColumn('{{%character_items}}', 'sub_item_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180325_143715_characterItemsUpdate cannot be reverted.\n";

        return false;
    }
    */
}
