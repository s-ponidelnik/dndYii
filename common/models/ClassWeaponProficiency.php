<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "class_weapon_proficiency".
 *
 * @property int $id
 * @property int $weapon_type_id
 * @property int $class_id
 *
 * @property _Class $class
 * @property WeaponType $weaponType
 */
class ClassWeaponProficiency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class_weapon_proficiency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['weapon_type_id', 'class_id'], 'integer'],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => _Class::className(), 'targetAttribute' => ['class_id' => 'id']],
            [['weapon_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => WeaponType::className(), 'targetAttribute' => ['weapon_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'weapon_type_id' => Yii::t('app', 'Weapon Type'),
            'class_id' => Yii::t('app', 'Class'),
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
    public function getWeaponType()
    {
        return $this->hasOne(WeaponType::className(), ['id' => 'weapon_type_id']);
    }
}
