<?php

namespace common\helpers;

use Yii;

class EncumbranceHelper
{
    const NONE_ENCUMBRANCE = 1;
    const LITTLE_ENCUMBRANCE = 2;
    const HEAVY_ENCUMBRANCE = 3;

    public static function getEncumbranceInfo($str)
    {
        return [
            5 * $str,
            15 * $str
        ];
    }

    public static function encumbranceDescription()
    {
        return [
            self::NONE_ENCUMBRANCE => Yii::t('app', "Not encumbered"),
            self::LITTLE_ENCUMBRANCE => Yii::t('app', "Little encumbered"),
            self::HEAVY_ENCUMBRANCE => Yii::t('app', "Heavily encumbered"),
        ];
    }
    public static function encumbranceDescriptionInfo()
    {
        return [
            self::NONE_ENCUMBRANCE => ['status'=>self::NONE_ENCUMBRANCE,'text'=>Yii::t('app', "Not encumbered")],
            self::LITTLE_ENCUMBRANCE => ['status'=>self::LITTLE_ENCUMBRANCE,'text'=>Yii::t('app', "Little encumbered")],
            self::HEAVY_ENCUMBRANCE => ['status'=>self::HEAVY_ENCUMBRANCE,'text'=>Yii::t('app', "Heavily encumbered")],
        ];
    }

    public static function getEncumbranceDescriptionInfo($str, $total)
    {
        $encumbrance = self::EncumbranceCalculate($str, $total);

        return isset(self::encumbranceDescriptionInfo()[$encumbrance]) ? self::encumbranceDescriptionInfo()[$encumbrance] : self::encumbranceDescriptionInfo()[self::NONE_ENCUMBRANCE];
    }

    public static function EncumbranceSpeedModifierCalculate($str, $total)
    {
        $encumbrance = self::EncumbranceCalculate($str, $total);
        if ($encumbrance == self::LITTLE_ENCUMBRANCE)
            return -10;
        elseif ($encumbrance == self::HEAVY_ENCUMBRANCE)
            return -20;
        return 0;
    }

    public static function EncumbranceCalculate($str, $total)
    {
        $encumbranceInfo = self::getEncumbranceInfo($str);
        if ($total < $encumbranceInfo[0])
            return self::NONE_ENCUMBRANCE;
        if ($total > $encumbranceInfo[0] && $total < $encumbranceInfo[1])
            return self::LITTLE_ENCUMBRANCE;
        if ($total > $encumbranceInfo[1])
            return self::HEAVY_ENCUMBRANCE;
    }
}
