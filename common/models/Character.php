<?php

namespace common\models;

use common\helpers\EncumbranceHelper;
use Yii;

/**
 * This is the model class for table "character".
 *
 * @property int $id
 * @property int $race_id
 * @property string hpStatusText
 *
 * @property float $percHp
 * @property string $name
 * @property string $icon_src
 * @property string $moneyString
 * @property int $hp
 * @property int $max_hp
 * @property int $exp
 * @property int $ac
 * @property int $speed
 * @property int $player_id
 * @property int $proficiencyBonus
 * @property string $proficiencyBonus_string
 * @property [] $skills
 * @property int $level
 * @property float $loadWeight
 * @property array $loadWeightInfo
 * @property array $encumbranceStatusInfo
 * @property CharacterClass $baseClass
 *
 * @property Race $race
 * @property CharacterAbility[] $characterAbilities
 * @property ClassMagicLevelPoint[] $spellMaxPoints
 * @property CharacterSpellPoints[] characterSpellPoints
 * @property CharacterClass[] $characterClasses
 * @property CharacterTalent[] $characterTalents
 * @property CharacterAbility[] $abilities
 * @property CharacterSkill[] $characterSkills
 * @property CharacterItems[] $characterItems
 * @property CharacterItems[] $mainItems
 *
 * @property CharacterItems[] $characterEquip
 * @property characterMoney[] $characterMoney
 * @property Talent[] $talents
 */
class Character extends \yii\db\ActiveRecord
{
    public $handyman = false;
    public $dualdef = false;
    public $armordef = false;
    public $charAura = false;
    const DEFAULT_AC = 10;
    public $casterLevel = 0;
    public $spellPoints = [];

    public $spellDiffAdditional = 0;
    public $spellAttackAdditional = 0;

    public function getAmmunition()
    {
        $ammunition = [];
        foreach ($this->characterItems as $characterItem) {
            if ($characterItem->item->item_type == Items::AMMUNITION_TYPE) {
                $ammunition[$characterItem->id] = ['name' => $characterItem->item->name, 'count' => $characterItem->count, 'description' => $characterItem->item->description];

            }
        }
        return $ammunition;
    }

    public function getWeapons()
    {
        $dex = $this->getAbility('DEX');
        $str = $this->getAbility('STR');
        $damageBonus = 0;
        $weapons = [];
        /** @var \common\models\CharacterItems $characterItem */
        foreach ($this->characterItems as $characterItem) {
            if ($characterItem->item->item_type == Items::WEAPON_TYPE) {
                $weapons[$characterItem->item->id] = [
                    'name' => $characterItem->item->name,
                    'description' => $characterItem->item->description
                ];

                if (is_object($characterItem->item->weaponProperty) && $characterItem->item->weaponProperty->fit && $dex->finalValue > $str->finalValue) {
                    $weapons[$characterItem->item->id]['attack'] = $dex->modifier;
                    $damageBonus = $dex->modifier;
                } else {
                    $weapons[$characterItem->item->id]['attack'] = $str->modifier;
                    $damageBonus = $str->modifier;
                }
                $weapons[$characterItem->item->id]['attack'] = $weapons[$characterItem->item->id]['attack'] + $this->proficiencyBonus;
                if (!empty($characterItem->item->weaponProperty->attack_bonus)) {
                    $weapons[$characterItem->item->id]['attack'] = $weapons[$characterItem->item->id]['attack'] + $characterItem->item->weaponProperty->attack_bonus;
                }
                if (!empty($characterItem->item->weaponProperty->damage_bonus)) {
                    $damageBonus = $damageBonus + $characterItem->item->weaponProperty->damage_bonus;
                }
                if (is_object($characterItem->item->weaponProperty))
                    $weapons[$characterItem->item->id]['damage'] = $characterItem->item->weaponProperty->damage_dice;
                else
                    $weapons[$characterItem->item->id]['damage'] = '';
                if (!empty($characterItem->item->weaponProperty->two_hand_damage_dice))
                    $weapons[$characterItem->item->id]['damage'] = $weapons[$characterItem->item->id]['damage'] . '(' . $characterItem->item->weaponProperty->two_hand_damage_dice . ')';
                if ($damageBonus > 0)
                    $weapons[$characterItem->item->id]['damage'] = $weapons[$characterItem->item->id]['damage'] . '+' . $damageBonus;
                elseif ($damageBonus < 0)
                    $weapons[$characterItem->item->id]['damage'] = $weapons[$characterItem->item->id]['damage'] . '-' . $damageBonus;

                if ($this->checkAttack_2()) {
                    $weapons[$characterItem->item->id]['attack'] = $weapons[$characterItem->item->id]['attack'] + 2;
                }

                if ($weapons[$characterItem->item->id]['attack'] >= 0) {
                    $weapons[$characterItem->item->id]['attack'] = '+' . $weapons[$characterItem->item->id]['attack'];
                }

            }
        }
        return $weapons;
    }

    public function getBaseClass()
    {
        return CharacterClass::find()->where(['character_id' => $this->id, 'base_class' => 1])->one();
    }

    public function getLevelSpellPoints($level)
    {
        if (empty($this->spellPoints))
            $this->getSpellMaxPoints();
        if (!isset($this->spellPoints[$level]))
            $this->spellPoints[$level] = 0;
        return $this->spellPoints[$level];
    }

    public function getFullSpellPointsInfo()
    {
        $info = [];
        $spellInfo = $this->getSpellMaxPoints();
        foreach ($spellInfo as $level => $points) {
            $info[$level] = [
                'max_points' => $points,
                'used' => $this->getUsedSpellPoint($level)
            ];
        }
        ksort($info);
        return $info;
    }

    public function useSpellPoint($level)
    {
        $points = $this->getLevelSpellPoints($level);
        if ($points == 0)
            return false;

        if ($points - $this->getUsedSpellPoint($level) < 0)
            return false;

        /** @var CharacterSpellPoints $usedSpellPoint */
        $usedSpellPoint = CharacterSpellPoints::find()->where(['character_id' => $this->id, 'spell_level' => $level])->one();
        if (is_object($usedSpellPoint)) {
            $usedSpellPoint->spell_point = $usedSpellPoint->spell_point + 1;
        } else {
            $usedSpellPoint->spell_level = $level;
            $usedSpellPoint->character_id = $this->id;
            $usedSpellPoint->spell_point = 1;
        }
        return $usedSpellPoint->save();

    }

    public function getUsedSpellPoint($level)
    {
        /** @var CharacterSpellPoints $usedPoints */
        $usedPoints = CharacterSpellPoints::find()->where(['character_id' => $this->id, 'spell_level' => $level])->one();
        if (!empty($usedPoints))
            return $usedPoints->spell_point;
        return 0;
    }

    public function rest()
    {
        CharacterSpellPoints::rest($this);
    }

    public function getSpellMaxPoints()
    {
        $spellPoints = CharacterSpellPoints::getMax($this);
        /** @var ClassMagicLevelPoint $spellPoint */
        foreach ($spellPoints as $spellPoint) {
            $this->spellPoints[$spellPoint->spell_level] = $spellPoint->spell_point;
        }
        return $this->spellPoints;
    }

    public function profInSavingThrow($abilityID)
    {
        if (is_object($this->baseClass)) {
            $classSavingThrows = ClassSavingThrows::find()->select(['ability_id'])->where(['ability_id' => $abilityID, 'class_id' => $this->baseClass->class_id])->count();
            if ($classSavingThrows > 0) {
                return 'active';
            }
        }


        return 'disable';
    }

    public function getSavingThrows()
    {
        $this->checkHandyman();
        $this->checkCharAura();
        $cha = $this->getAbility('CHA');
        if (is_object($this->baseClass))
            $classSavingThrows = ClassSavingThrows::find()->select(['ability_id'])->where(['class_id' => $this->baseClass->class_id])->column();
        else
            $classSavingThrows = [];
        $savingThrows = [];
        /** @var CharacterAbility $ability */
        foreach ($this->abilities as $ability) {
            if (in_array($ability->ability_id, $classSavingThrows))
                $savingThrows[$ability->ability->name] = $ability->modifier + $this->proficiencyBonus;
            elseif ($this->handyman) {
                $savingThrows[$ability->ability->name] = $ability->modifier + (int)($this->proficiencyBonus / 2);
            } else {
                $savingThrows[$ability->ability->name] = $ability->modifier;
            }
            if ($this->charAura && is_object($cha)) {
                $savingThrows[$ability->ability->name] = $savingThrows[$ability->ability->name] + $cha->modifier;
            }
        }
        foreach ($savingThrows as $k => $v) {
            if ($v > 0) {
                $savingThrows[$k] = '+' . $v;
            }
        }
        return $savingThrows;
    }

    public function getHpStatusText()
    {
        if ($this->getPercHp() < 40) return 'danger';
        elseif ($this->getPercHp() < 70) return 'warning';
        else return 'success';
    }

    public function getPercHp()
    {
        return $this->hp / ($this->max_hp / 100);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'character';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['race_id', 'hp', 'max_hp', 'exp', 'player_id'], 'integer'],
            [['name', 'icon_src'], 'string'],
            [['race_id'], 'exist', 'skipOnError' => true, 'targetClass' => Race::className(), 'targetAttribute' => ['race_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'race_id' => Yii::t('app', 'Race'),
            'name' => Yii::t('app', 'Character name'),
            'hp' => Yii::t('app', 'HP'),
            'max_hp' => Yii::t('app', 'Max HP'),
            'exp' => Yii::t('app', 'Exp'),
        ];
    }

    public function getAbilityModifier($nameID)
    {
        $modifier = $this->getAbility($nameID);
        return $modifier->modifier;
    }

    public function getAbility($nameID)
    {
        $ability = Ability::find()->where(['nameID' => $nameID])->one();
        $characterAbility = CharacterAbility::find()->where(['ability_id' => $ability->id, 'character_id' => $this->id])->one();
        if (!is_object($characterAbility)) {
            $characterAbility = new CharacterAbility();
            $characterAbility->ability_id = $ability->id;
            $characterAbility->value = 0;
            $characterAbility->character_id = $this->id;
        }
        return $characterAbility;
    }

    public function getAc()
    {
        $acInfo = $this->getCharacterAcInfo();
        return $acInfo['body'] + $acInfo['shield'] + $acInfo['additional'];
    }

    public function getLoadWeightInfo()
    {
        $info = [];
        /** @var CharacterItems $characterItem */
        foreach ($this->characterItems as $characterItem) {
            $weight = $characterItem->item->weight * $characterItem->count;
            if (is_object($characterItem->parent) && ($characterItem->parent->item->id == 129 || $characterItem->parent->item->id == 128))
                $weight = 0;
            $info[$characterItem->item->name] =
                [
                    'item' => $characterItem->item,
                    'one_weight' => $characterItem->item->weight,
                    'weight' => $weight,
                    'count' => $characterItem->count,
                ];

        }

        /*foreach ($this->characterMoney as $moneyItem) {
            $info[$moneyItem->currencyType->name] =
                [
                    'item' => $moneyItem->currencyType->name,
                    'weight' => $moneyItem->currencyType->weight * $moneyItem->count
                ];
        }*/
        return $info;
    }

    public function getInitiative()
    {
        /** @var CharacterAbility $dex */
        $dex = $this->getAbility('dex');
        return $dex->modifier_string;
    }

    public function getCharacterExpPosInfo()
    {
        $level = 0;
        foreach (self::getExpLevel() as $expLevelKey => $expLevel) {
            if ($this->exp > $expLevel) {
                $level = $expLevelKey;
            }
        }

        return [self::getExpLevel()[$level], self::getExpLevel()[$level + 1]];
    }

    public function getPassivePerception()
    {
        return '-';
    }

    public function progressExpLevel()
    {
        $lvlPos = $this->getCharacterExpPosInfo();
        $exp = $this->exp;
        $exp = $exp - $lvlPos[0];
        $lvlPos[1] = $lvlPos[1] - $lvlPos[0];
        $lvlPos[0] = 0;
        return $exp / ($lvlPos[1] / 100);
    }

    public function getCharacterExpLevel()
    {
        $level = 0;
        foreach (self::getExpLevel() as $expLevelKey => $expLevel) {
            if ($this->exp > $expLevel) {
                $level = $expLevelKey;
            }
        }
        return $level + 1;
    }

    public static function getExpLevel()
    {
        return [0, 300, 900, 2700, 6500, 14000, 23000, 34000, 48000, 64000, 85000, 100000, 120000, 140000, 165000, 195000, 225000, 265000, 305000, 355000];
    }

    public function getLoadWeight()
    {
        $loadWeight = 0;
        foreach ($this->characterItems as $characterItem) {
            if ((is_object($characterItem->parent) && $characterItem->parent->item->id != 129 && $characterItem->parent->item->id != 128) || !is_object($characterItem->parent))
                $loadWeight = $loadWeight + ($characterItem->item->weight * $characterItem->count);
        }
        /** @var CharacterMoney $moneyItem */
        foreach ($this->characterMoney as $moneyItem) {
            $loadWeight = $loadWeight + ($moneyItem->currencyType->weight * $moneyItem->count);
        }
        return $loadWeight;
    }

    public function getCharacterAcInfo()
    {
        $dexModifier = $this->getAbilityModifier('DEX');
        $baseAC = self::DEFAULT_AC + $dexModifier;
        $twoWeaponCheck = 0;

        $info = ['items' => [], 'body' => $baseAC, 'shield' => 0, 'additional' => 0];

        $bodyArmor = false;
        $shield = false;
        $additionalAC = 0;
        /** @var \common\models\CharacterItems $characterItem */
        foreach ($this->characterEquip as $characterItem) {
            /** @var \common\models\Items $item */
            $equipItem = $characterItem->item;
            if ($equipItem->item_type == Items::ARMOR_TYPE) {
                /** @var ArmorProperty $armorProperty */
                $armorProperty = $equipItem->armorProperties;
                if (is_object($armorProperty)) {
                    if ($armorProperty->type_id == ArmorType::BODY_ARMOR_TYPE && $bodyArmor === false) {
                        if ($armorProperty->dex_mod) {
                            if (!empty($armorProperty->dex_mod_limit)) {
                                if ($dexModifier > $armorProperty->dex_mod_limit)
                                    $dexModifier = $armorProperty->dex_mod_limit;
                            }
                        } else {
                            $dexModifier = 0;
                        }
                        $bodyArmor = true;
                        $baseAC = $armorProperty->ac + $dexModifier;
                        $info['body'] = $baseAC;
                        $info['items'][$equipItem->id] = ['ac' => $baseAC, 'item' => $equipItem];
                    } elseif ($armorProperty->type_id == ArmorType::SHIELD_TYPE && $shield === false) {
                        $info['items'][$equipItem->id] = ['ac' => $armorProperty->ac, 'item' => $equipItem];
                        $info['shield'] = $armorProperty->ac;
                        $shield = true;
                    } elseif ($armorProperty->type_id == ArmorType::OTHER_ARMOR) {
                        $additionalAC = $additionalAC + $armorProperty->ac;
                        $info['items'][$equipItem->id] = ['ac' => $armorProperty->ac, 'item' => $equipItem];
                    }
                }
            }
        }
        $info['additional'] = $additionalAC;
        if ($this->checkDualdef()) {
            /** @var CharacterItems $charItem */
            foreach (CharacterItems::find()->where(['character_id' => $this->id, 'equip' => 1])->all() as $charItem) {
                if ($charItem->item->item_type == Items::WEAPON_TYPE) {
                    $twoWeaponCheck++;
                }
            }
            if ($twoWeaponCheck > 1) {
                $info['additional'] = $info['additional'] + 1;

            }
        }
        if ($twoWeaponCheck > 1) {
            $info['additional'] = $info['additional'] + 1;
        }
        if ($this->checkArmordef()) {
            $armorDefCheck = false;
            /** @var CharacterItems $charItem */
            foreach (CharacterItems::find()->where(['character_id' => $this->id, 'equip' => 1])->all() as $charItem) {
                if ($charItem->item->item_type == Items::ARMOR_TYPE) {
                    if ($charItem->item->armorProperty->type_id == ArmorType::BODY_ARMOR_TYPE)
                        $armorDefCheck = true;

                }
            }
            if ($armorDefCheck)
                $info['additional'] = $info['additional'] + 1;
        }

        return $info;
    }

    public function getCharacterEquip()
    {
        return CharacterItems::find()->where(['character_id' => $this->id, 'equip' => 1])->all();
    }

    public function getEncumbranceLimits()
    {
        $str = $this->getAbility('STR');
        if (is_object($str))
            return EncumbranceHelper::getEncumbranceInfo($str->finalValue);
        return [50, 150];
    }

    public function getEncumbranceStatusInfo()
    {
        /** @var CharacterAbility $str */
        $str = $this->getAbility('STR');
        if (is_object($str))
            return EncumbranceHelper::getEncumbranceDescriptionInfo($str->finalValue, $this->loadWeight);
        return EncumbranceHelper::encumbranceDescriptionInfo()[EncumbranceHelper::NONE_ENCUMBRANCE];
    }

    public function getSpeed()
    {
        $speed = $this->race->speed;
        /** @var CharacterAbility $str */
        $str = $this->getAbility('STR');
        if (is_object($str))
            $speed = $speed + EncumbranceHelper::EncumbranceSpeedModifierCalculate($str->finalValue, $this->loadWeight);
        return $speed;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRace()
    {
        return $this->hasOne(Race::className(), ['id' => 'race_id']);
    }

    public function getFullCharacterAbilities()
    {

        $characterAbilities = $this->abilities;
        $abilities = Ability::find()->all();
        $notIn = [];
        /** @var Ability $ability */
        foreach ($abilities as $ability) {
            $find = false;
            /** @var CharacterAbility $characterAbility */
            foreach ($characterAbilities as $characterAbility) {
                if ($ability->id === $characterAbility->ability_id) {
                    $find = true;
                }
            }
            if ($find === false)
                $notIn[] = $ability->id;
        }

        foreach ($notIn as $ability_id) {
            $newCharacterAbility = new CharacterAbility();
            $newCharacterAbility->character_id = $this->id;
            $newCharacterAbility->ability_id = $ability_id;
            $characterAbilities[] = $newCharacterAbility;
        }
        return $characterAbilities;
    }

    public function getAbilities()
    {
        return $this->hasMany(CharacterAbility::className(), ['character_id' => 'id']);

    }

    public function getCharacterSkills()
    {
        return $this->hasMany(CharacterSkill::className(), ['character_id' => 'id']);

    }

    public function getMainItems()
    {
        return $this->hasMany(CharacterItems::className(), ['character_id' => 'id'])->andWhere(['sub_item_id' => null]);
    }

    public function getCharacterItems()
    {
        return $this->hasMany(CharacterItems::className(), ['character_id' => 'id']);

    }

    public function getMoneyString()
    {
        $money = [];
        foreach ($this->characterMoney as $characterMoney) {
            $money[] = $characterMoney->count . ' ' . $characterMoney->currencyType->_short_name;
        }
        if (empty($money)) {
            $cur = Currency::find()->select(['short_name'])->one();
            $money[] = 0 . ' ' . $cur->_short_name;
        }
        return implode(',', $money);
    }

    public function getCharacterMoney()
    {
        return $this->hasMany(CharacterMoney::className(), ['character_id' => 'id']);

    }

    public function getSkills()
    {
        $this->checkHandyman();
        $skills = Skill::find()->all();

        $characterSkillsModifiers = [];
        /** @var CharacterSkill $characterSkill */
        foreach ($this->characterSkills as $characterSkill) {
            $characterSkillsModifiers[$characterSkill->skill_id] = $characterSkill;
        }
        $characterSkills = [];
        $characterAbility = [];

        /** @var CharacterAbility $ability */
        foreach ($this->abilities as $ability) {
            $characterAbility[$ability->ability_id] = $ability;
        }
        /** @var Skill $skill */
        foreach ($skills as $skill) {
            $characterSkills[$skill->id] = [
                'skill' => $skill,
                'proficiency' => false,
                'expertise' => false
            ];
            $profMod = 0;
            if (isset($characterSkillsModifiers[$skill->id])) {
                if ($characterSkillsModifiers[$skill->id]->proficiency) {
                    $profMod = $this->proficiencyBonus;
                    $characterSkills[$skill->id]['proficiency'] = 1;
                    if ($characterSkillsModifiers[$skill->id]->expertise) {
                        $profMod = $this->proficiencyBonus * 2;
                        $characterSkills[$skill->id]['expertise'] = 1;
                    }
                } elseif ($this->handyman) {
                    $profMod = (int)($this->proficiencyBonus / 2);
                }
            }
            if (isset($characterAbility[$skill->ability->id])) {
                $characterSkills[$skill->id]['value'] = $characterAbility[$skill->ability->id]->modifier + $profMod;
            } else {
                $characterSkills[$skill->id]['value'] = 0;
            }
            $characterSkills[$skill->id]['value_string'] = ($characterSkills[$skill->id]['value'] < 0) ? $characterSkills[$skill->id]['value'] : '+' . $characterSkills[$skill->id]['value'];
        }
        return $characterSkills;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacterAbilities()
    {
        return $this->hasMany(CharacterAbility::className(), ['character_id' => 'id']);
    }

    public function checkHandyman()
    {
        if (!$this->handyman) {
            /** @var Talent $talent */
            foreach ($this->talents as $talent) {
                if ($talent->name == 'handyman') {
                    $this->handyman = true;
                }
            }
        }
        return $this->handyman;
    }

    public function checkMagicDiff()
    {
        $madic_diff_1 = false;
        $madic_diff_2 = false;
        $bonus = 0;
        /** @var Talent $talent */
        foreach ($this->talents as $talent) {
            if ($talent->name == 'magic_diff_2') {
                $madic_diff_2 = true;
            }
            if ($talent->name == 'magic_diff_1') {
                $madic_diff_1 = true;
            }
        }
        $this->spellDiffAdditional = 0;
        if ($madic_diff_1)
            $this->spellDiffAdditional += 1;
        if ($madic_diff_2)
            $this->spellDiffAdditional += 2;
        return $this->spellDiffAdditional;
    }

    public function checkAttack_2()
    {
        $attack_2 = false;
        /** @var Talent $talent */
        foreach ($this->talents as $talent) {
            if ($talent->name == 'attack_2')
                $attack_2 = true;
        }
        return $attack_2;
    }

    public function checkMagicAttack()
    {
        $madic_diff_1 = false;
        $madic_diff_2 = false;
        /** @var Talent $talent */
        foreach ($this->talents as $talent) {
            if ($talent->name == 'magic_attack_2') {
                $madic_diff_2 = true;
            }
            if ($talent->name == 'magic_attack_1') {
                $madic_diff_1 = true;
            }
        }
        $this->spellAttackAdditional = 0;
        if ($madic_diff_1)
            $this->spellAttackAdditional += 1;
        if ($madic_diff_2)
            $this->spellAttackAdditional += 2;
        return $this->spellAttackAdditional;
    }

    public function checkDualdef()
    {
        if (!$this->dualdef) {
            /** @var Talent $talent */
            foreach ($this->talents as $talent) {
                if ($talent->name == 'dualdef') {
                    $this->dualdef = true;
                }
            }
        }
        return $this->dualdef;
    }

    public function checkArmordef()
    {
        if (!$this->armordef) {
            /** @var Talent $talent */
            foreach ($this->talents as $talent) {
                if ($talent->name == 'armordef') {
                    $this->armordef = true;
                }
            }
        }
        return $this->armordef;
    }

    public function checkCharAura()
    {
        if (!$this->charAura) {
            /** @var Talent $talent */
            foreach ($this->talents as $talent) {
                if ($talent->name == 'charAura') {
                    $this->charAura = true;
                }
            }
        }
        return $this->charAura;
    }

    public function getSpellCasterDiff()
    {
        if (!is_object($this->baseClass))
            return '-';
        /** @var _Class $baseClass */
        $baseClass = $this->baseClass->class;
        if (empty($baseClass->spell_ability_id)) {
            return '-';
        }
        $this->checkMagicDiff();

        $spellAbility = $this->getAbility($baseClass->spell_ability->nameID);
        return $this->proficiencyBonus + $spellAbility->modifier + 8 + $this->spellDiffAdditional;
    }

    public function getSpellCasterAttack()
    {
        if (!is_object($this->baseClass))
            return '-';
        /** @var _Class $baseClass */
        $baseClass = $this->baseClass->class;
        if (empty($baseClass->spell_ability_id)) {
            return '-';
        }
        $this->checkMagicAttack();
        $spellAbility = $this->getAbility($baseClass->spell_ability->nameID);
        $mod = $this->proficiencyBonus + $spellAbility->modifier + $this->spellAttackAdditional;
        if ($mod >= 0)
            return '+' . $mod;
        else
            return $mod;
    }

    public function getUsedTalents()
    {
        $usedTalentsArr = [];
        $usedTalents = CharacterTalentUsed::find()->select(['talent_id', 'used'])->where(['character_id' => $this->id])->all();
        /** @var CharacterTalentUsed $usedTalent */
        foreach ($usedTalents as $usedTalent) {
            $usedTalentsArr[$usedTalent->talent_id] = $usedTalent->used;
        }
        return $usedTalentsArr;
    }

    public function getClassTalent($talent_id)
    {
        $level = 0;
        $talent = null;
        /** @var CharacterClass $characterClass */
        foreach ($this->characterClasses as $characterClass) {
            /** @var ClassTalent $ClassTalent */
            $ClassTalent = ClassTalent::find()
                ->where(['class_id' => $characterClass->classesIds, 'talent_id' => $talent_id])
                ->andWhere('level<=:level', ['level' => $characterClass->level])
                ->orderBy(['level' => SORT_DESC])
                ->one();
            if (is_object($ClassTalent))
                if ($ClassTalent->level > $level)
                    $talent = $ClassTalent;
        }
        return $talent;
    }

    public function getTalents()
    {
        $classTalents = [];
        $talents = [];
        /** @var CharacterClass $characterClass */
        foreach ($this->characterClasses as $characterClass) {
            /** @var ClassTalent $talent */
            foreach ($characterClass->class->classTalents as $talent) {
                if ($characterClass->level >= $talent->level) {
                    if (isset($classTalents[$talent->talent->name])) {
                        if ($talent->level > $classTalents[$talent->talent->name]->level) {
                            $classTalents[$talent->talent->name] = $talent;
                        }
                    } else {
                        $classTalents[$talent->talent->name] = $talent;
                    }

                }
            }
        }
        foreach ($classTalents as $talent) {
            $talent->talent->property = $talent->property;
            $talents[] = $talent->talent;
        }
        foreach ($this->race->allTalents as $talent) {
            $talents[] = $talent->talent;
        }
        /** @var CharacterTalent $talent */
        foreach ($this->characterTalents as $talent) {
            $talents[] = $talent->talent;
        }
        return $talents;
    }


    public function getLevel()
    {
        $level = 0;
        foreach ($this->characterClasses as $characterClass) {
            $level = $level + $characterClass->level;
        }
        return $level;
    }

    public function getCharacterTalents()
    {
        return $this->hasMany(CharacterTalent::className(), ['character_id' => 'id']);
    }

    public function getClassesInfo()
    {
        $info = [];
        foreach ($this->characterClasses as $characterClass) {
            $info[] = $characterClass->class->_name . ' ' . $characterClass->level;
        }
        return implode('/', $info);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacterClasses()
    {
        return $this->hasMany(CharacterClass::className(), ['character_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacterSpellPoints()
    {
        return $this->hasMany(CharacterSpellPoints::className(), ['character_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer()
    {
        return $this->hasOne(User::className(), ['id' => 'player_id']);
    }


    public function getProficiencyBonus()
    {
        $proficiencyBonus = ProficiencyBonusLevelRel::find()->select(['proficiency_bonus'])->where(['level' => $this->level])->scalar();
        return $proficiencyBonus;
    }

    public function getProficiencyBonus_string()
    {
        return $this->proficiencyBonus < 0 ? $this->proficiencyBonus : '+' . $this->proficiencyBonus;
    }

    public static function getAllList()
    {
        $charactersList = [];
        $characters = Character::find()->select(['id', 'name'])->all();
        foreach ($characters as $character) {
            $charactersList[$character->id] = $character->name;
        }
        return $charactersList;
    }
}
