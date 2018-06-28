<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "armor_type".
 *
 * @property int $id
 * @property int $additional_ac
 * @property string $name
 * @property integer $group
 * @property integer $don
 * @property integer $doff
 * @property integer $don_time_type
 * @property integer $doff_time_type
 * @property string $desc
 */
class ArmorType extends \yii\db\ActiveRecord
{

    public $_name;

    const TIME_MINUTE = 0;
    const TIME_ACTION = 1;

    const BODY_ARMOR_TYPE = 0;
    const SHIELD_TYPE = 1;
    const OTHER_ARMOR = 2;

    public static function getTypeList(){
        return [
            self::BODY_ARMOR_TYPE=>Yii::t('app','Base body armor'),
            self::SHIELD_TYPE=>Yii::t('app','Shield type'),
            self::OTHER_ARMOR=>Yii::t('app','Other armor'),
        ];
    }
    public static function getTimeTypes()
    {
        return [
            self::TIME_MINUTE => Yii::t('app', 'minute'),
            self::TIME_ACTION => Yii::t('app', 'action'),
        ];
    }

    public function getDoffTimeTypeName()
    {
        return self::getTimeTypes()[$this->doff_time_type];
    }

    public function getDonTimeTypeName()
    {
        return self::getTimeTypes()[$this->don_time_type];
    }



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'armor_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['don', 'doff', 'don_time_type', 'doff_time_type', 'additional_ac','group'], 'integer'],
            [['name'], 'unique'],
            [['name'], 'string', 'max' => 255],
            [['desc'], 'string'],
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
            'don' => Yii::t('app', 'Don'),
            'doff' => Yii::t('app', 'Doff'),
            'doff_time_type' => Yii::t('app', 'Doff Time Type'),
            'don_time_type' => Yii::t('app', 'Don Time Type'),
            'group'=>Yii::t('app','Group'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->_name = Yii::t('app/items', $this->name);
        parent::afterFind();
    }

    public static function getAllList()
    {
        $armorTypeList = [];
        $armorTypes = ArmorType::find()->where(['group' => 0])->select(['id', 'name'])->all();
        /** @var ArmorType $armorType */
        foreach ($armorTypes as $armorType) {
            $armorTypeList[$armorType->id] = $armorType->_name;
        }
        return $armorTypeList;
    }

    public static function getAllGroupList()
    {
        $armorTypeList = [];
        $armorTypes = ArmorType::find()->where(['group' => 1])->select(['id', 'name'])->all();
        /** @var ArmorType $armorType */
        foreach ($armorTypes as $armorType) {
            $armorTypeList[$armorType->id] = $armorType->_name;
        }
        return $armorTypeList;
    }
    public static function getFullList(){
        $armorTypeList = [];
        $armorTypes = ArmorType::find()->select(['id', 'name'])->all();
        /** @var ArmorType $armorType */
        foreach ($armorTypes as $armorType) {
            $armorTypeList[$armorType->id] = $armorType->_name;
        }
        return $armorTypeList;
    }
}
