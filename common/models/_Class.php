<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "_class".
 *
 * @property int $id
 * @property string $name
 * @property string $hit_dice
 * @property integer $first_level_hit_points
 * @property string $hit_points_per_level
 * @property integer $hit_points_per_level_stable
 * @property int $archetype
 * @property int $parent_id
 * @property int $spell_ability_id
 * @property float $caster_value
 * @property int $magic_proficiency_type
 * @property int $class_skill_proficiency
 *
 * @property _Class $parent
 * @property _Class[] $classes
 * @property CharacterClass[] $characterClasses
 * @property ClassMagicLevelPoint[] $classMagicLevelPoints
 * @property ClassMagicPoint[] $classMagicPoints
 * @property ClassSkillProficiency[] $classSkillProficiencies
 * @property ClassTalent[] $classTalents
 * @property ClassTalent[] $parentTalents
 * @property ClassTalent[] $selfTalents
 * @property ClassSavingThrows[] $classSavingThrows
 * @property ClassSavingThrows[] parentClassSavingThrows
 * @property ClassSavingThrows[] selfClassSavingThrows
 * @property ClassArmorProficiency[] $classArmorProficiency
 * @property ClassArmorProficiency[] $selfArmorProficiency
 * @property ClassArmorProficiency[] $parentArmorProficiency
 * @property ClassWeaponProficiency[] $classWeaponProficiency
 * @property ClassWeaponProficiency[] $selfWeaponProficiency
 * @property ClassWeaponProficiency[] $parentWeaponProficiency
 * @property ClassToolsProficiency[] $classToolsProficiency
 * @property ClassToolsProficiency[] $selfToolsProficiency
 * @property ClassToolsProficiency[] $parentToolsProficiency
 * @property Ability $spell_ability
 */
class _Class extends \yii\db\ActiveRecord
{
    public $_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '_class';
    }

    const NO_MAGIC = 0;
    const PREPARE_MAGIC = 1;
    const KNOWN_SPELLS = 2;

    public static function magicProficiencyTypes()
    {
        return [
            self::NO_MAGIC => 'Нет магических способностей',
            self::PREPARE_MAGIC => 'Подготовка магии(Волшебник)',
            self::KNOWN_SPELLS => 'Известные заклинания',
        ];
    }

    public function getMagicProficiencyTypeName()
    {
        return self::magicProficiencyTypes()[$this->magic_proficiency_type];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'magic_proficiency_type', 'class_skill_proficiency', 'hit_points_per_level_stable', 'first_level_hit_points', 'spell_ability_id'], 'integer'],
            [['name', 'hit_dice', 'hit_points_per_level', 'caster_value'], 'string', 'max' => 255],
            [['archetype'], 'string', 'max' => 1],
            [['name'], 'unique'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => _Class::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'caster_value' => Yii::t('app', 'caster_value'),
            'archetype' => Yii::t('app', 'Archetype'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'class_skill_proficiency' => Yii::t('app', 'Number of class skills'),
            'magic_proficiency_type' => Yii::t('app', 'Magician type'),
            'hit_dice' => Yii::t('app', 'Hit Dice'),
            'first_level_hit_points' => Yii::t('app', 'Hit Points on first level'),
            'hit_points_per_level' => Yii::t('app', 'Hit Points per level'),
            'hit_points_per_level_stable' => Yii::t('app', 'Hit Points per level(without dice throw)'),
            'spell_ability_id' => Yii::t('app', 'Spell ability'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(_Class::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClasses()
    {
        return $this->hasMany(_Class::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacterClasses()
    {
        return $this->hasMany(CharacterClass::className(), ['class_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassMagicLevelPoints()
    {
        return $this->hasMany(ClassMagicLevelPoint::className(), ['class_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassMagicPoints()
    {
        return $this->hasMany(ClassMagicPoint::className(), ['class_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassSkillProficiencies()
    {
        return $this->hasMany(ClassSkillProficiency::className(), ['class_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassTalents()
    {
        return array_merge($this->selfTalents, $this->parentTalents);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelfTalents()
    {
        return $this->hasMany(ClassTalent::className(), ['class_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentTalents()
    {
        return $this->hasMany(ClassTalent::className(), ['class_id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpell_ability()
    {
        return $this->hasOne(Ability::className(), ['id' => 'spell_ability_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassSavingThrows()
    {
        return array_merge(
            $this->parentClassSavingThrows,
            $this->selfClassSavingThrows
        );
    }

    public function getParentClassSavingThrows()
    {
        return $this->hasMany(ClassSavingThrows::className(), ['class_id' => 'parent_id']);
    }

    public function getSelfClassSavingThrows()
    {
        return $this->hasMany(ClassSavingThrows::className(), ['class_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassArmorProficiency()
    {
        return array_merge($this->selfArmorProficiency, $this->parentArmorProficiency);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelfArmorProficiency()
    {
        return $this->hasMany(ClassArmorProficiency::className(), ['class_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentArmorProficiency()
    {
        return $this->hasMany(ClassArmorProficiency::className(), ['class_id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassWeaponProficiency()
    {
        return array_merge($this->selfWeaponProficiency, $this->parentWeaponProficiency);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelfWeaponProficiency()
    {
        return $this->hasMany(ClassWeaponProficiency::className(), ['class_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentWeaponProficiency()
    {
        return $this->hasMany(ClassWeaponProficiency::className(), ['class_id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassToolsProficiency()
    {
        return array_merge($this->selfToolsProficiency, $this->parentToolsProficiency);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelfToolsProficiency()
    {
        return $this->hasMany(ClassToolsProficiency::className(), ['class_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentToolsProficiency()
    {
        return $this->hasMany(ClassToolsProficiency::className(), ['class_id' => 'parent_id']);
    }

    public static function getAllList($onlyParent = false, $withNull = true)
    {
        if ($withNull)
            $classList = [null => '-'];
        else
            $classList = [];
        $classes = \common\models\_Class::find()
            ->select(['id', 'name']);
        if ($onlyParent)
            $classes = $classes->where(['parent_id' => null]);
        foreach ($classes->all() as $class) {
            $classList[$class->id] = $class->_name;
        }
        return $classList;
    }

    public function afterFind()
    {
        $this->_name = Yii::t('app/classes', $this->name);
        parent::afterFind();
    }


}
