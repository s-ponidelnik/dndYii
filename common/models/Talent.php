<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "talent".
 *
 * @property int $id
 * @property string $name
 * @property string $_name
 * @property string $_fullname
 * @property integer $count
 * @property integer $rest_condition
 * @property integer $rest_type
 * @property boolean $scalable
 *
 * @property string $description
 * @property string $property
 *
 * @property ClassTalent[] $classTalents
 * @property RaceTalent[] $raceTalents
 */
class Talent extends \yii\db\ActiveRecord
{
    const FULL_REST = 1;
    const FAST_REST = 2;
    const FULL_OR_FAST_REST = 3;
    const DAWN = 4;
    const SUNDOWN = 5;

    public $property = null;
    public $_name;
    public function getRest_type(){
        return self::getRestTypes()[$this->rest_condition];
    }
    public static function getRestTypes()
    {
        return [
            self::FULL_REST => Yii::t('app', 'Full Rest'),
            self::FAST_REST => Yii::t('app', 'Fast Rest'),
            self::FULL_OR_FAST_REST => Yii::t('app', 'Full or Fast Rest'),
            self::DAWN => Yii::t('app', 'Dawn'),
            self::SUNDOWN => Yii::t('app', 'Sundown')
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'talent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['count', 'rest_condition','scalable'], 'integer'],
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
            'description' => Yii::t('app', 'Description'),
            'rest_condition' => Yii::t('app', 'rest_condition'),
            'count' => Yii::t('app', 'count'),
            'scalable' => Yii::t('app', 'Scalable'),
        ];
    }

    public function get_Fullname()
    {
        return $this->_name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassTalents()
    {
        return $this->hasMany(ClassTalent::className(), ['talent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaceTalents()
    {
        return $this->hasMany(RaceTalent::className(), ['talent_id' => 'id']);
    }

    public static function getAllList()
    {
        $talents = Talent::find()->select(['id', 'name'])->all();
        $talentList = [];
        /** @var Talent $talent */
        foreach ($talents as $talent) {
            $talentList[$talent->id] = $talent->_name;
        }
        return $talentList;
    }

    public function afterFind()
    {
        $this->_name = Yii::t('app/talents', $this->name);
        parent::afterFind();
    }
}
