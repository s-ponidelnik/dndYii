<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "race".
 *
 * @property int $id
 * @property string $name
 * @property string $_name;
 * @property Race $mainRace
 * @property string $_fullname;
 * @property boolean $playable;
 * @property int $parent_id
 * @property int $speed
 * @property string $info
 * @property string $ideology
 * @property string $age
 * @property string $size
 *
 * @property Character[] $characters
 * @property Race $parent
 * @property RaceAbilityModifier[] $raceAbilityModifiers
 * @property RaceAbilityModifier[] $parentAbilityModifiers
 * @property RaceAbilityModifier[] $allAbilityModifiers
 * @property RaceSkillProficiency[] $raceSkillProficiencies
 * @property RaceSkillProficiency[] $parentSkillProficiencies
 * @property RaceSkillProficiency[] $allSkillProficiencies
 * @property RaceTalent[] $raceTalents
 * @property RaceTalent[] $parentTalents
 * @property RaceTalent[] $allTalents
 */
class Race extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'race';
    }

    public $_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'playable'], 'required'],
            [['parent_id', 'speed', 'playable'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['info', 'ideology', 'age', 'size', 'names'], 'string'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Race::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'playable' => Yii::t('app', 'Playable'),
            '_name' => Yii::t('app', 'Name'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'info' => Yii::t('app', 'Info'),
            'speed' => Yii::t('app', 'Speed'),
            'ideology' => Yii::t('app', 'Ideology'),
            'age' => Yii::t('app', 'Age'),
            'size' => Yii::t('app', 'Size'),
            'names' => Yii::t('app', 'Names'),
        ];
    }

    public function afterFind()
    {
        if (empty($this->speed) && $this->parent_id > 0) {
            $this->speed = $this->parent->speed;
        }
        $this->_name = Yii::t('app/race', $this->name);
        parent::afterFind();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters()
    {
        return $this->hasMany(Character::className(), ['race_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Race::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaces()
    {
        return $this->hasMany(Race::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaceAbilityModifiers()
    {
        return $this->hasMany(RaceAbilityModifier::className(), ['race_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentAbilityModifiers()
    {
        return $this->hasMany(RaceAbilityModifier::className(), ['race_id' => 'parent_id']);
    }

    public function getAllAbilityModifiers()
    {
        return array_merge($this->raceAbilityModifiers, $this->parentAbilityModifiers);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaceSkillProficiencies()
    {
        return $this->hasMany(RaceSkillProficiency::className(), ['race_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentSkillProficiencies()
    {
        return $this->hasMany(RaceSkillProficiency::className(), ['race_id' => 'parent_id']);
    }

    public function getAllSkillProficiencies()
    {
        return array_merge($this->raceSkillProficiencies, $this->parentSkillProficiencies);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaceTalents()
    {
        return $this->hasMany(RaceTalent::className(), ['race_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentTalents()
    {
        return $this->hasMany(RaceTalent::className(), ['race_id' => 'parent_id']);
    }

    public function getAllTalents()
    {
        return array_merge($this->raceTalents, $this->parentTalents);
    }

    public function get_Fullname()
    {
        return !empty($this->parent->_name) ? $this->_name . ' / ' . $this->parent->_name : $this->_name;
    }

    public function getMainRace()
    {
        if (!empty($this->parent))
            return $this->parent->getMainRace();
        else
            return $this;
    }

    public static function getAllList($clearRace = false)
    {
        $races = Race::find()->select(['id', 'name', 'parent_id']);
        if ($clearRace == true)
            $races = $races->where(['parent_id' => null]);
        $raceList = [];
        /** @var Race $race */
        foreach ($races->all() as $race) {
            if (empty($race->parent)) {
                $raceList[$race->id] = $race->_name;
            } else {
                $raceList[$race->id] = $race->_fullname;
            }

        }
        return $raceList;
    }
}
