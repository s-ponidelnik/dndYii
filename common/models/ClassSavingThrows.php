<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "class_saving_throws".
 *
 * @property int $id
 * @property int $class_id
 * @property int $ability_id
 *
 * @property Ability $ability
 * @property _Class $class
 */
class ClassSavingThrows extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class_saving_throws';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_id', 'ability_id'], 'integer'],
            [['ability_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ability::className(), 'targetAttribute' => ['ability_id' => 'id']],
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
            'class_id' => Yii::t('app', 'Class ID'),
            'ability_id' => Yii::t('app', 'Ability ID'),
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
    public function getClass()
    {
        return $this->hasOne(_Class::className(), ['id' => 'class_id']);
    }
}
