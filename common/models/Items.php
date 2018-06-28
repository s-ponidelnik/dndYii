<?php

namespace common\models;

use Yii;
use yii\rbac\Item;

/**
 * This is the model class for table "items".
 *
 * @property int $id
 * @property int $packable
 * @property int $item_type
 * @property string $name
 * @property string $_name
 * @property double $cost
 * @property int $currency_type_id
 * @property double $weight
 * @property string $description
 * @property string $short_description
 * @property string $type
 *
 * @property ArmorProperty $armorProperties
 * @property ArmorProperty $armorProperty
 * @property ArmorTypeArmorRel[] $armorTypeArmorRels
 * @property CharacterItems[] $characterItems
 * @property Currency $currencyType
 * @property WeaponProperties[] $weaponProperties
 * @property WeaponProperty $weaponProperty
 * @property WeaponTypeWeaponRel[] $weaponTypeWeaponRels
 */
class Items extends \yii\db\ActiveRecord
{

    const WEAPON_TYPE = 1;
    const ARMOR_TYPE = 2;
    const TOOLS_TYPE = 3;
    const OTHER_TYPE = 4;
    const AMMUNITION_TYPE = 5;

    public static function getTypes()
    {
        return [
            self::WEAPON_TYPE => Yii::t('app', 'Weapon'),
            self::ARMOR_TYPE => Yii::t('app', 'Armor'),
            self::TOOLS_TYPE => Yii::t('app', 'Tools'),
            self::OTHER_TYPE => Yii::t('app', 'Other'),
            self::AMMUNITION_TYPE => Yii::t('app', 'Ammunition')
        ];
    }

    public static function getList($type = null)
    {
        $itemsList = [];
        $items = self::find()->select(['id', 'name']);
        if (!is_null($type))
            $items = $items->where(['item_type' => $type]);
        /** @var Items $item */
        foreach ($items->all() as $item) {
            $itemsList[$item->id] = $item->_name;
        }
        return $itemsList;
    }

    public static function getAllList()
    {
        return self::getList();
    }

    public static function getArmorsList()
    {
        return self::getList(self::ARMOR_TYPE);
    }

    public static function getWeaponList()
    {
        return self::getList(self::WEAPON_TYPE);
    }

    public function get_name()
    {
        return Yii::t('items', $this->name);
    }

    public function getType()
    {
        return self::getTypes()[$this->item_type];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_type', 'currency_type_id','packable'], 'integer'],
            [['name'], 'required'],
            [['cost', 'weight'], 'number'],
            [['description', 'short_description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['currency_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_type' => Yii::t('app', 'Item Type'),
            'type' => Yii::t('app', 'Item Type'),
            'name' => Yii::t('app', 'Name'),
            'cost' => Yii::t('app', 'Cost'),
            'currency_type_id' => Yii::t('app', 'Currency Type'),
            'weight' => Yii::t('app', 'Weight'),
            'description' => Yii::t('app', 'Description'),
            'short_description' => Yii::t('app', 'Short Description'),
            'packable' => Yii::t('app', 'packable'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArmorProperties()
    {
        return $this->hasOne(ArmorProperty::className(), ['item_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArmorProperty()
    {
        return $this->hasOne(ArmorProperty::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArmorTypeArmorRels()
    {
        return $this->hasMany(ArmorTypeArmorRel::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacterItems()
    {
        return $this->hasMany(CharacterItems::className(), ['item_id' => 'id']);
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
    public function getWeaponProperties()
    {
        return $this->hasMany(WeaponProperties::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeaponProperty()
    {
        return $this->hasOne(WeaponProperty::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeaponTypeWeaponRels()
    {
        return $this->hasMany(WeaponTypeWeaponRel::className(), ['item_id' => 'id']);
    }
}
