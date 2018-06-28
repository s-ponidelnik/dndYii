<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "token".
 *
 * @property int $id
 * @property string $portrait
 * @property string $border_color
 * @property string $background_color
 */
class Token extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['portrait', 'border_color', 'background_color'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'portrait' => Yii::t('app', 'Portrait'),
            'border_color' => Yii::t('app', 'Border Color'),
            'background_color' => Yii::t('app', 'Background Color'),
        ];
    }
}
