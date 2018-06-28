<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "character_skill".
 *
 * @property int $id
 * @property int $character_id
 * @property int $skill_id
 * @property int $proficiency
 * @property int $expertise
 *
 * @property Character $character
 * @property Skill $skill
 */
class CharacterSkill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'character_skill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['character_id', 'skill_id'], 'integer'],
            [['proficiency', 'expertise'], 'string', 'max' => 1],
            [['character_id'], 'exist', 'skipOnError' => true, 'targetClass' => Character::className(), 'targetAttribute' => ['character_id' => 'id']],
            [['skill_id'], 'exist', 'skipOnError' => true, 'targetClass' => Skill::className(), 'targetAttribute' => ['skill_id' => 'id']],
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
            'skill_id' => Yii::t('app', 'Skill'),
            'proficiency' => Yii::t('app', 'Proficiency'),
            'expertise' => Yii::t('app', 'Expertise'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacter()
    {
        return $this->hasOne(Character::className(), ['id' => 'character_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkill()
    {
        return $this->hasOne(Skill::className(), ['id' => 'skill_id']);
    }
}
