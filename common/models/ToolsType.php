<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tools_type".
 *
 * @property int $id
 * @property string $name
 * @property string $desc
 * @property string $short_desc
 *
 * @property Tools[] $tools
 */
class ToolsType extends \yii\db\ActiveRecord
{
    public $_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tools_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['desc','short_desc'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'desc' => Yii::t('app', 'Desc'),
            'short_desc' => Yii::t('app', 'Short Desc'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTools()
    {
        return $this->hasMany(Tools::className(), ['type_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->_name = Yii::t('app/tools', $this->name);
        parent::afterFind();
    }

    public static function getAllList()
    {
        $typeList = [];
        $types = ToolsType::find()->select(['id', 'name'])->all();
        foreach ($types as $type) {
            $typeList[$type->id] = $type->_name;
        }
        return $typeList;
    }
}
