<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "weapon_type_weapon_rel".
 *
 * @property int $id
 * @property int $weapon_id
 * @property int $type_id
 *
 * @property WeaponType $type
 * @property Weapon $weapon
 */
class WeaponTypeWeaponRel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weapon_type_weapon_rel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['weapon_id', 'type_id'], 'integer'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => WeaponType::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['weapon_id'], 'exist', 'skipOnError' => true, 'targetClass' => Weapon::className(), 'targetAttribute' => ['weapon_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'weapon_id' => Yii::t('app', 'Weapon ID'),
            'type_id' => Yii::t('app', 'Type ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(WeaponType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeapon()
    {
        return $this->hasOne(Weapon::className(), ['id' => 'weapon_id']);
    }
}
