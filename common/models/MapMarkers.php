<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "map_markers".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $img_name
 * @property int $type
 * @property int $sub_map_id
 * @property int $map_id
 * @property int $pos_x
 * @property int $pos_y
 *
 * @property Map $map
 * @property Map $map0
 */
class MapMarkers extends \yii\db\ActiveRecord
{
    public static function types(){
        return [
            0=>'town',
            1=>'cavern'
        ];
    }
    public function getTypeName(){
        return self::types()[$this->type];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'map_markers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'map_id','pos_x','pos_y'], 'required'],
            [['description'], 'string'],
            [['type', 'sub_map_id', 'map_id','pos_x','pos_y'], 'integer'],
            [['name', 'img_name'], 'string', 'max' => 255],
            [['map_id'], 'exist', 'skipOnError' => true, 'targetClass' => Map::className(), 'targetAttribute' => ['map_id' => 'id']],
            [['sub_map_id'], 'exist', 'skipOnError' => true, 'targetClass' => Map::className(), 'targetAttribute' => ['sub_map_id' => 'id']],
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
            'description' => Yii::t('app', 'Description'),
            'img_name' => Yii::t('app', 'Img Name'),
            'type' => Yii::t('app', 'Type'),
            'pos_x' => Yii::t('app', 'Pos_x'),
            'pos_y' => Yii::t('app', 'Pos_y'),
            'sub_map_id' => Yii::t('app', 'Sub Map ID'),
            'map_id' => Yii::t('app', 'Map ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMap()
    {
        return $this->hasOne(Map::className(), ['id' => 'map_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubMap()
    {
        return $this->hasOne(Map::className(), ['id' => 'sub_map_id']);
    }
}
