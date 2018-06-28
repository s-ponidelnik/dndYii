<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "weapon_properties".
 *
 * @property int $id
 * @property int $weapon_id
 * @property int $property
 * @property string $property_value
 *
 * @property Weapon $weapon
 */
class WeaponProperties extends \yii\db\ActiveRecord
{

    const Property_Ammunition = 0;
    const Property_Finesse = 1;
    const Property_Heavy = 2;
    const Property_Light = 3;
    const Property_Loading = 4;
    const Property_Range = 5;
    const Property_Reach = 6;
    const Property_Special = 7;
    const Property_Thrown = 8;
    const Property_Two_Handed = 9;
    const Property_Versatile = 10;


    public static function getProperties()
    {
        return [
            self::Property_Ammunition => Yii::t('app/items', 'Ammunition'),
            self::Property_Finesse => Yii::t('app/items', 'Finesse'),
            self::Property_Heavy => Yii::t('app/items', 'Heavy'),
            self::Property_Light => Yii::t('app/items', 'Light'),
            self::Property_Loading => Yii::t('app/items', 'Loading'),
            self::Property_Range => Yii::t('app/items', 'Range'),
            self::Property_Reach => Yii::t('app/items', 'Reach'),
            self::Property_Special => Yii::t('app/items', 'Special'),
            self::Property_Thrown => Yii::t('app/items', 'Thrown'),
            self::Property_Two_Handed => Yii::t('app/items', 'Two Handed'),
            self::Property_Versatile => Yii::t('app/items', 'Versatile'),
        ];
    }

    public function getPropertyName()
    {
        return self::getProperties()[$this->property];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weapon_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['weapon_id', 'property'], 'integer'],
            [['property'], 'required'],
            [['property_value'], 'string', 'max' => 255],
            [['weapon_id'], 'exist', 'skipOnError' => true, 'targetClass' => Weapon::className(), 'targetAttribute' => ['weapon_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'weapon_id' => Yii::t('app', 'Weapon'),
            'property' => Yii::t('app', 'Property'),
            'property_value' => Yii::t('app', 'Property Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeapon()
    {
        return $this->hasOne(Weapon::className(), ['id' => 'weapon_id']);
    }
}
