<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "weapon_property".
 *
 * @property int $id
 * @property int $item_id
 * @property string $damage_dice
 * @property string $two_hand_damage_dice
 * @property integer $damage_bonus
 * @property integer $attack_bonus
 * @property bool $fit
 *
 * @property Items $item
 */
class WeaponProperty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weapon_property';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'attack_bonus', 'damage_bonus','fit'], 'integer'],
            [['damage_dice'], 'required'],
            [['damage_dice', 'two_hand_damage_dice'], 'string', 'max' => 255],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'damage_dice' => Yii::t('app', 'Damage Dice'),
            'two_hand_damage_dice' => Yii::t('app', 'Two Hand Damage Dice'),
            'attack_bonus' => Yii::t('app', 'attack_bonus'),
            'damage_bonus' => Yii::t('app', 'damage_bonus'),
            'fit' => Yii::t('app', 'fit'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }
}
