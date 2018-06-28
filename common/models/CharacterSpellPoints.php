<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "character_spell_points".
 *
 * @property int $id
 * @property int $character_id
 * @property int $spell_level
 * @property int $spell_point
 *
 * @property Character $character
 */
class CharacterSpellPoints extends \yii\db\ActiveRecord
{
    public static function rest($character)
    {
        CharacterSpellPoints::deleteAll(['character_id' => $character->id]);
    }

    public static function getMax($character)
    {
        $spellPoints = [];
        $classes = [];
        $dt = CharacterClass::find()->where(['character_id' => $character->id])->all();
        /** @var CharacterClass $cClass */
        foreach ($dt as $cClass) {
            if (is_object($cClass->class) && $cClass->class->magic_proficiency_type != _Class::NO_MAGIC) {
                $classes[] = $cClass;
            }
        }
        if (count($classes) == 1) {
            $character->casterLevel = $classes[0]->level;
            $spellPoints = ClassMagicLevelPoint::getByClassLevel($classes[0]->class_id, $classes[0]->level);
        } elseif (count($classes) > 1) {
            $spellCasterLevel = 0;
            /** @var CharacterClass $class */
            foreach ($classes as $class) {
                $spellCasterLevel += $class->level * $class->class->caster_value;
            }
            $spellCasterLevel = intval($spellCasterLevel);
            $character->casterLevel = $spellCasterLevel;
            $spellPoints = MulticlassMagicLevelPoint::getByLevel($spellCasterLevel);
        }
        return $spellPoints;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'character_spell_points';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['character_id', 'spell_level', 'spell_point'], 'integer'],
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
            'character_id' => Yii::t('app', 'Character ID'),
            'spell_level' => Yii::t('app', 'Spell Level'),
            'spell_point' => Yii::t('app', 'Spell Point'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacter()
    {
        return $this->hasOne(Character::className(), ['id' => 'character_id']);
    }
}
