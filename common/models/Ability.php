<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ability".
 *
 * @property int $id
 * @property string $name
 * @property string $nameID
 * @property string $desc
 *
 * @property RaceAbilityModifier[] $raceAbilityModifiers
 * @property Skill[] $skills
 * @property Skill[] $skills0
 */
class Ability extends \yii\db\ActiveRecord
{


    public $_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ability';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc', 'name', 'nameID'], 'string'],
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
            'nameID' => Yii::t('app', 'NameID'),
            'desc' => Yii::t('app', 'Desc'),
        ];
    }

    public function getShort_name()
    {
        return mb_substr($this->_name, 0, 3);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaceAbilityModifiers()
    {
        return $this->hasMany(RaceAbilityModifier::className(), ['ability_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::className(), ['ability_id' => 'id']);
    }

    public static function getAllList($withNull = false)
    {
        $allAbility = Ability::find()->select(['id', 'name', 'nameID'])->all();
        if ($withNull)
            $abilityList = [null => '-'];
        else
            $abilityList = [];
        foreach ($allAbility as $ability) {
            $abilityList[$ability->id] = $ability->name . '(' . $ability->nameID . ')';
        }
        return $abilityList;
    }


    public function afterFind()
    {
        $this->_name = Yii::t('app/ability', $this->name);
        parent::afterFind();
    }
}
