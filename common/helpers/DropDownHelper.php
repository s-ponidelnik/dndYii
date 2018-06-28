<?php

namespace common\helpers;

use Yii;

class DropDownHelper
{
    public static function BooleanDropDown()
    {
        return [
            0 => Yii::t('app', 'No'),
            1 => Yii::t('app', 'Yes')
        ];
    }
}
