<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "character_items".
 *
 * @property int $id
 * @property int $character_id
 * @property int $item_id
 * @property int $count
 * @property int $sub_item_id
 * @property int $equip
 *
 * @property Character $character
 * @property CharacterItems $parent
 * @property Items $item
 * @property ItemsIn $itemsIn
 */
class CharacterItems extends \yii\db\ActiveRecord
{

    public function getParent()
    {
        return $this->hasOne(CharacterItems::className(), ['id' => 'sub_item_id']);
    }

    public static function getForSubItems($character_id)
    {
        $res = [null => '-'];
        $character_items = CharacterItems::find()->where(['character_id' => $character_id])->all();
        /** @var CharacterItems $character_item */
        foreach ($character_items as $character_item) {
            if ($character_item->item->packable)
                $res[$character_item->id] = $character_item->item->name . '(#' . $character_item->id . ')';
        }
        return $res;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'character_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['character_id', 'item_id', 'count', 'sub_item_id'], 'integer'],
            [['equip'], 'string', 'max' => 1],
            [['character_id'], 'exist', 'skipOnError' => true, 'targetClass' => Character::className(), 'targetAttribute' => ['character_id' => 'id']],
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
            'character_id' => Yii::t('app', 'Character ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'count' => Yii::t('app', 'Count'),
            'sub_item_id' => Yii::t('app', 'sub_item_id'),
            'equip' => Yii::t('app', 'Equip'),
        ];
    }

    public function getItemsIn()
    {
        return $this->hasMany(CharacterItems::className(), ['sub_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacter()
    {
        return $this->hasOne(Character::className(), ['id' => 'character_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }
}
