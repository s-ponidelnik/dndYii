<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "armor_type_armor_rel".
 *
 * @property int $id
 * @property int $armor_id
 * @property int $type_id
 *
 * @property Armor $armor
 * @property ArmorType $type
 */
class ArmorTypeArmorRel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'armor_type_armor_rel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['armor_id', 'type_id'], 'integer'],
            [['armor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Armor::className(), 'targetAttribute' => ['armor_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArmorType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'armor_id' => Yii::t('app', 'Armor ID'),
            'type_id' => Yii::t('app', 'Type ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArmor()
    {
        return $this->hasOne(Armor::className(), ['id' => 'armor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ArmorType::className(), ['id' => 'type_id']);
    }
}
