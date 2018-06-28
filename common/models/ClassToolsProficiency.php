<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "class_tools_proficiency".
 *
 * @property int $id
 * @property int $tools_object_id
 * @property int $class_id
 * @property int $count
 *
 * @property _Class $class
 * @property Object $toolsObject
 */
class ClassToolsProficiency extends \yii\db\ActiveRecord
{
    public $sub_select = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class_tools_proficiency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tools_object_id', 'class_id', 'count'], 'integer'],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => _Class::className(), 'targetAttribute' => ['class_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tools_object_id' => Yii::t('app', 'Tools'),
            'class_id' => Yii::t('app', 'Class'),
            'count' => Yii::t('app', 'Count'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(_Class::className(), ['id' => 'class_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToolsObject()
    {
        if ($this->count == 1)
            return $this->hasOne(Tools::className(), ['id' => 'tools_object_id']);
        else
            return $this->hasOne(ToolsType::className(), ['id' => 'tools_object_id']);
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        if ($this->count>1)
            $this->sub_select = true;
    }
}
