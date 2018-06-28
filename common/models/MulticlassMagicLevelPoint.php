<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "multiclass_magic_level_point".
 *
 * @property int $id
 * @property int $spell_level
 * @property int $spell_point
 * @property int $level
 */
class MulticlassMagicLevelPoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'multiclass_magic_level_point';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spell_level', 'spell_point', 'level'], 'integer'],
        ];
    }

    public static function getByLevel($CasterLevel)
    {
        return self::find()->where(['level' => $CasterLevel])->all();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'spell_level' => Yii::t('app', 'Spell Level'),
            'spell_point' => Yii::t('app', 'Spell Point'),
            'level' => Yii::t('app', 'Level'),
        ];
    }
}
