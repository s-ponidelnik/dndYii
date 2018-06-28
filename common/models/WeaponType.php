<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "weapon_type".
 *
 * @property int $id
 * @property int $parent_type_id
 * @property string $name
 */
class WeaponType extends \yii\db\ActiveRecord
{
    public $_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weapon_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
            [['name'], 'string', 'max' => 255],
            [['parent_type_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'parent_type_id' => Yii::t('app', 'Parent Type ID'),
            'parent_type' => Yii::t('app', 'Parent Type'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->_name = Yii::t('app/items', $this->name);
        parent::afterFind();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentType()
    {
        return $this->hasOne(WeaponType::className(), ['id' => 'parent_type_id']);
    }

    public function getAllOther()
    {
        $typeList = self::getAllList();
        unset($typeList[$this->id]);
        $typeList[0] = '-';
        return $typeList;
    }

    public static function getAllList()
    {
        $typeList = [];
        $types = \common\models\WeaponType::find()
            ->select(['id', 'name'])
            ->all();
        foreach ($types as $type) {
            $typeList[$type->id] = $type->_name;
        }
        return $typeList;
    }

}
