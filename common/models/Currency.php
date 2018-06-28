<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property string $name
 * @property string $short_name
 * @property double $value_weight
 * @property double $weight
 *
 */
class Currency extends \yii\db\ActiveRecord
{
    public $_name;
    public $_short_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'short_name', 'value_weight'], 'required'],
            [['value_weight'], 'number'],
            [['weight'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['short_name'], 'string', 'max' => 2],
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
            '_name' => Yii::t('app', 'Name'),
            'short_name' => Yii::t('app', 'Short Name'),
            '_short_name' => Yii::t('app', 'Short Name'),
            'value_weight' => Yii::t('app', 'Value Weight'),
            'weight' => Yii::t('app', 'Weight'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArmors()
    {
        return $this->hasMany(Armor::className(), ['currency_type_id' => 'id']);
    }

    public function afterFind()
    {
        $this->_name = Yii::t('app/currency', $this->name);
        $this->_short_name = Yii::t('app/currency', $this->short_name);
        parent::afterFind();
    }

    public static function getAllList($withNull = true)
    {
        if ($withNull)
            $currencyTypeList = [null => '-'];
        else
            $currencyTypeList = [];
        $currencyTypes = Currency::find()->select(['id', 'name'])->all();

        /** @var Currency $currencyType */
        foreach ($currencyTypes as $currencyType) {
            $currencyTypeList[$currencyType->id] = $currencyType->_name;
        }
        return $currencyTypeList;
    }


}
