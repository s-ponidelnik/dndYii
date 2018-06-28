<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "class_magic_level_point".
 *
 * @property int $id
 * @property int $spell_level
 * @property int $spell_point
 * @property int $level
 * @property int $class_id
 *
 * @property _Class $class
 */
class ClassMagicLevelPoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class_magic_level_point';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spell_level', 'spell_point', 'level', 'class_id'], 'integer'],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => _Class::className(), 'targetAttribute' => ['class_id' => 'id']],
        ];
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
            'class_id' => Yii::t('app', 'Class'),
        ];
    }

    public static function getByClassLevel($class_id, $level)
    {
        return self::find()->where(['level' => $level, 'class_id' => $class_id])->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(_Class::className(), ['id' => 'class_id']);
    }
}
