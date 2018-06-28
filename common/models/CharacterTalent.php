<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "character_talent".
 *
 * @property int $id
 * @property int $character_id
 * @property int $talent_id
 * @property int $used
 *
 * @property Character $character
 * @property Talent $talent
 * @property CharacterTalentUsed $usedObj
 */
class CharacterTalent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'character_talent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['character_id', 'talent_id'], 'integer'],
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
            'character_id' => Yii::t('app', 'Character'),
            'talent_id' => Yii::t('app', 'Talent'),
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

    public function getUsedObj()
    {
        return $this->hasOne(CharacterTalentUsed::className(), ['talent_id' => 'talent_id', 'character_id' => 'character_id']);
    }

    public function getUsed()
    {

        $used = CharacterTalentUsed::find()->select(['used'])->where(['character_id' => $this->character_id, 'talent_id' => $this->talent_id])->scalar();
        if (!$used) {
            $usedObj = new CharacterTalentUsed();
            $usedObj->character_id = $this->character_id;
            $usedObj->talent_id = $this->talent_id;
            if (!$usedObj->save()) {
                //TODO::add log here
            }
            return $usedObj->used;
        }
        return $used;
    }
}
