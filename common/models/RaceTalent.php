<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "race_talent".
 *
 * @property int $id
 * @property int $race_id
 * @property int $talent_id
 *
 * @property Race $race
 * @property Talent $talent
 */
class RaceTalent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'race_talent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['race_id', 'talent_id'], 'integer'],
            [['race_id'], 'exist', 'skipOnError' => true, 'targetClass' => Race::className(), 'targetAttribute' => ['race_id' => 'id']],
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
            'race_id' => Yii::t('app', 'Race ID'),
            'talent_id' => Yii::t('app', 'Talent ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRace()
    {
        return $this->hasOne(Race::className(), ['id' => 'race_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTalent()
    {
        return $this->hasOne(Talent::className(), ['id' => 'talent_id']);
    }
}
