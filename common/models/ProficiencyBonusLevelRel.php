<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "proficiency_bonus_level_rel".
 *
 * @property int $id
 * @property int $proficiency_bonus
 * @property int $level
 */
class ProficiencyBonusLevelRel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proficiency_bonus_level_rel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['proficiency_bonus'], 'required'],
            [['proficiency_bonus', 'level'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'proficiency_bonus' => Yii::t('app', 'Proficiency Bonus'),
            'level' => Yii::t('app', 'Level'),
        ];
    }
}
