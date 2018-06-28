<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "class_talent".
 *
 * @property int $id
 * @property int $class_id
 * @property int $level
 * @property int $property
 * @property int $talent_id
 *
 * @property _Class $class
 * @property Talent $talent
 */
class ClassTalent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class_talent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_id', 'talent_id', 'level'], 'integer'],
            [['property'],'string'],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => _Class::className(), 'targetAttribute' => ['class_id' => 'id']],
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
            'level' => Yii::t('app', 'Level'),
            'class_id' => Yii::t('app', 'Class'),
            'talent_id' => Yii::t('app', 'Talent'),
            'property' => Yii::t('app', 'Property'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(_Class::className(), ['id' => 'class_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTalent()
    {
        return $this->hasOne(Talent::className(), ['id' => 'talent_id']);
    }
}
