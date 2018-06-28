<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "character_talent_used".
 *
 * @property int $id
 * @property int $character_id
 * @property int $talent_id
 * @property int $used
 *
 * @property Character $character
 * @property Talent $talent
 */
class CharacterTalentUsed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'character_talent_used';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['character_id', 'talent_id', 'used'], 'integer'],
            [['character_id'], 'exist', 'skipOnError' => true, 'targetClass' => Character::className(), 'targetAttribute' => ['character_id' => 'id']],
            [['talent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Talent::className(), 'targetAttribute' => ['talent_id' => 'id']],
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
            'talent_id' => Yii::t('app', 'Talent ID'),
            'used' => Yii::t('app', 'Used'),
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
    public function getTalent()
    {
        return $this->hasOne(Talent::className(), ['id' => 'talent_id']);
    }
}
