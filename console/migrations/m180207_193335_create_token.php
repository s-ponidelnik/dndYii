<?php

use yii\db\Migration;

/**
 * Class m180207_193335_create_token
 */
class m180207_193335_create_token extends Migration
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
        $this->createTable('{{%token}}', [
            'id' => $this->primaryKey(),
            'portrait'=>$this->string(),
            'border_color'=>$this->string(),
            'background_color'=>$this->string()

        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%token}}');
    }
}
