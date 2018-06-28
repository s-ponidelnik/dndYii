<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "armor_property".
 *
 * @property int $id
 * @property int $item_id
 * @property int $type_id
 * @property int $ac
 * @property int $str
 * @property int $stealth_disadvantage
 * @property int $dex_mod
 * @property int $dex_mod_limit
 *
 * @property Items $item
 */
class ArmorProperty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'armor_property';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'type_id', 'ac', 'str', 'dex_mod_limit'], 'integer'],
            [['stealth_disadvantage', 'dex_mod'], 'string', 'max' => 1],
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
            'item_id' => Yii::t('app', 'Item'),
            'type_id' => Yii::t('app', 'Type'),
            'ac' => Yii::t('app', 'Ac'),
            'str' => Yii::t('app', 'Str'),
            'stealth_disadvantage' => Yii::t('app', 'Stealth Disadvantage'),
            'dex_mod' => Yii::t('app', 'Dex Mod'),
            'dex_mod_limit' => Yii::t('app', 'Dex Mod Limit'),
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
