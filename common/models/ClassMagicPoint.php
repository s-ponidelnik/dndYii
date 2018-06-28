<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "class_magic_point".
 *
 * @property int $id
 * @property int $spell_point
 * @property int $level
 * @property int $class_id
 *
 * @property _Class $class
 */
class ClassMagicPoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class_magic_point';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spell_point', 'level', 'class_id'], 'integer'],
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
            'spell_point' => Yii::t('app', 'Spell Point'),
            'level' => Yii::t('app', 'Level'),
            'class_id' => Yii::t('app', 'Class ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(_Class::className(), ['id' => 'class_id']);
    }
}
