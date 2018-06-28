<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "class_armor_proficiency".
 *
 * @property int $id
 * @property int $armor_type_id
 * @property int $class_id
 *
 * @property ArmorType $armorType
 * @property _Class $class
 */
class ClassArmorProficiency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class_armor_proficiency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['armor_type_id', 'class_id'], 'integer'],
            [['armor_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArmorType::className(), 'targetAttribute' => ['armor_type_id' => 'id']],
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
            'armor_type_id' => Yii::t('app', 'Armor Type'),
            'class_id' => Yii::t('app', 'Class'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArmorType()
    {
        return $this->hasOne(ArmorType::className(), ['id' => 'armor_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(_Class::className(), ['id' => 'class_id']);
    }
}
