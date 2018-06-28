<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "spell".
 *
 * @property int $id
 * @property string $name
 * @property int $level
 * @property string $spell_school_id
 * @property int $overlay_time
 * @property int $overlay_time_type
 * @property int $distance
 * @property int $concentration
 * @property string $components
 * @property int $duration_time
 * @property int $duration_time_type
 * @property string $description
 */
class Spell extends \yii\db\ActiveRecord
{

    const TIME_TYPE_ACTION = 1;
    const TIME_TYPE_BONUS_ACTION = 2;
    const TIME_TYPE_MIN = 3;
    const TIME_TYPE_HOUR = 4;
    const TIME_TYPE_DAY = 5;

    public static function getTimeType()
    {
        return [
            self::TIME_TYPE_ACTION => Yii::t('app', 'action'),
            self::TIME_TYPE_BONUS_ACTION => Yii::t('app', 'bonus action'),
            self::TIME_TYPE_MIN => Yii::t('app', 'minutes'),
            self::TIME_TYPE_HOUR => Yii::t('app', 'hours'),
            self::TIME_TYPE_DAY => Yii::t('app', 'days'),
        ];
    }

    public static function getTimeTypeName($type)
    {
        return self::getTimeType()[$type];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spell';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'overlay_time_type', 'duration_time_type', 'description', 'concentration'], 'required'],
            [['level', 'overlay_time', 'overlay_time_type', 'distance', 'duration_time', 'duration_time_type','spell_school_id'], 'integer'],
            [['description'], 'string'],
            [['name', 'components'], 'string', 'max' => 255],
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
            'level' => Yii::t('app', 'Level'),
            'spell_school_id' => Yii::t('app', 'Spell School'),
            'overlay_time' => Yii::t('app', 'Overlay Time'),
            'overlay_time_type' => Yii::t('app', 'Overlay Time Type'),
            'distance' => Yii::t('app', 'Distance'),
            'components' => Yii::t('app', 'Components'),
            'duration_time' => Yii::t('app', 'Duration Time'),
            'duration_time_type' => Yii::t('app', 'Duration Time Type'),
            'description' => Yii::t('app', 'Description'),
            'concentration' => Yii::t('app', 'Concentration'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpellSchool()
    {
        return $this->hasOne(SpellSchool::className(), ['id' => 'spell_school_id']);
    }
}
