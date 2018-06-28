<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "character_ability".
 *
 * @property int $id
 * @property int $character_id
 * @property int $value
 * @property int $ability_id
 * @property int $finalValue
 *
 * @property int $modifier
 * @property string $modifier_string
 * @property int $characterModifier
 * @property string $characterModifier_string
 * @property int $raceModifier
 * @property Character $character
 * @property Ability $ability
 */
class CharacterAbility extends \yii\db\ActiveRecord
{
    public function getFinalValue()
    {
        return $this->value + $this->raceModifier;
    }


    public function getCharacterModifier()
    {
        return intval(($this->value - 10) / 2);
    }

    public function getCharacterModifier_string()
    {
        return $this->characterModifier < 0 ? $this->characterModifier : '+' . $this->characterModifier;
    }

    public function getModifier()
    {
        return intval(($this->finalValue - 10) / 2);
    }

    public function getModifier_string()
    {
        return $this->modifier < 0 ? $this->modifier : '+' . $this->modifier;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'character_ability';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['character_id', 'ability_id', 'value'], 'integer'],
            [['character_id'], 'exist', 'skipOnError' => true, 'targetClass' => Character::className(), 'targetAttribute' => ['character_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'character_id' => Yii::t('app', 'Character'),
            'ability_id' => Yii::t('app', 'Ability'),
            'value' => Yii::t('app', 'Value'),
            'modifier' => Yii::t('app', 'Modifier'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacter()
    {
        return $this->hasOne(Character::className(), ['id' => 'character_id']);
    }

    public function getCharacterT()
    {
        return Character::find()->where(['id' => $this->character_id])->one();
    }

    public function getRaceModifier()
    {
        $races = [];
        $races[] = $this->character->race_id;
        $races[] = $this->character->race->parent_id;
        $race = $this->character->race;
        while (true) {
            if (empty($race->parent_id) || in_array($race->parent_id, $races)) {
                $races[] = $race->id;
                break;
            } else {
                $race = $race->parent;
                $races[] = $race->id;
            }
        }
        $mod = 0;
        $raceModifiers = RaceAbilityModifier::find()->where([
            'race_id' => $races,
            'ability_id' => $this->ability_id
        ])->all();
        /** @var RaceAbilityModifier $raceModifier */
        foreach ($raceModifiers as $raceModifier) {
            $mod = $mod + $raceModifier->modifier;
        }
        return $mod;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbility()
    {
        return $this->hasOne(Ability::className(), ['id' => 'ability_id']);
    }
}
