<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "race_ability_modifier".
 *
 * @property int $id
 * @property int $ability_id
 * @property int $modifier
 * @property int $race_id
 *
 * @property Ability $ability
 * @property Race $race
 */
class RaceAbilityModifier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'race_ability_modifier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ability_id', 'modifier', 'race_id'], 'integer'],
            [['ability_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ability::className(), 'targetAttribute' => ['ability_id' => 'id']],
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
            'ability_id' => Yii::t('app', 'Ability ID'),
            'modifier' => Yii::t('app', 'Modifier'),
            'race_id' => Yii::t('app', 'Race ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbility()
    {
        return $this->hasOne(Ability::className(), ['id' => 'ability_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRace()
    {
        return $this->hasOne(Race::className(), ['id' => 'race_id']);
    }
}
