<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "character_party".
 *
 * @property int $id
 * @property int $character_id
 * @property string $party_identifier
 * @property int $party_leader
 *
 * @property Character $character
 */
class CharacterParty extends \yii\db\ActiveRecord
{
    public static function giveExp($party_identifier, $exp)
    {
        $characters = CharacterParty::find()->where(['party_identifier' => $party_identifier])->with('character')->all();
        $expForEvery = $exp / count($characters);
        foreach ($characters as $character) {
            $character->character->exp = intval($character->character->exp + $expForEvery);
            if (!$character->character->save()) {
                var_dump($character->character->getErrors());
                return false;
            }
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'character_party';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['character_id'], 'integer'],
            [['party_identifier'], 'required'],
            [['party_identifier'], 'string', 'max' => 255],
            [['party_leader'], 'string', 'max' => 1],
            [['character_id', 'party_identifier', 'party_leader'], 'unique', 'targetAttribute' => ['character_id', 'party_identifier', 'party_leader']],
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
            'party_identifier' => Yii::t('app', 'Party Identifier'),
            'party_leader' => Yii::t('app', 'Party Leader'),
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
