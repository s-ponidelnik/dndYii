<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tools".
 *
 * @property int $id
 * @property int $type_id
 * @property string $desc
 * @property string $short_desc
 * @property string $name
 * @property double $cost
 * @property int $currency_type_id
 * @property double $weight
 *
 * @property ClassToolsProficiency[] $classToolsProficiencies
 * @property Currency $currencyType
 * @property ToolsType $type
 */
class Tools extends \yii\db\ActiveRecord
{
    public $_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tools';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc', 'name', 'short_desc'], 'string'],
            [['name'], 'required'],
            [['cost', 'weight'], 'number'],
            [['currency_type_id', 'type_id'], 'integer'],
            [['currency_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_type_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ToolsType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'desc' => Yii::t('app', 'Desc'),
            'short_desc' => Yii::t('app', 'Short Desc'),
            'name' => Yii::t('app', 'Name'),
            '_name' => Yii::t('app', 'Name'),
            'cost' => Yii::t('app', 'Cost'),
            'currency_type_id' => Yii::t('app', 'Currency Type ID'),
            'weight' => Yii::t('app', 'Weight'),
            'type_id' => Yii::t('app', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassToolsProficiencies()
    {
        return $this->hasMany(ClassToolsProficiency::className(), ['tools_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyType()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ToolsType::className(), ['id' => 'type_id']);
    }

    public function getFullDesc()
    {
        if (empty($this->desc) && (!empty($this->type_id) && !empty($this->type->desc)))
            return $this->type->desc;
        return $this->desc;
    }

    public function getFullShortDesc()
    {
        if (empty($this->short_desc) && (!empty($this->type_id) && !empty($this->type->short_desc)))
            return $this->type->short_desc;
        return $this->short_desc;
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
        $toolsList = [];
        $tools = Tools::find()->select(['id', 'name'])->all();
        foreach ($tools as $tool) {
            $toolsList[$tool->id] = $tool->_name;
        }
        return $toolsList;
    }
}
