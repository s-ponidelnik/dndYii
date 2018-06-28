<?php

namespace common\components;

use Yii;

class DamageHelper
{
    const ACID = 0;
    const LIGHTING = 1;
    const FIRE = 2;
    const POISON = 3;
    const COLD = 4;
    const BLUDGEONING = 5;
    const PIERCING = 6;
    const SLASHING = 7;
    const PSYCHIC = 8;
    const NO_DAMAGE = 9;

    public static function getDamageTypes()
    {
        return [
            self::BLUDGEONING => Yii::t('app/damage', 'bludgeoning'),
            self::PIERCING => Yii::t('app/damage', 'piercing'),
            self::SLASHING => Yii::t('app/damage', 'slashing'),
            self::ACID => Yii::t('app/damage', 'acid'),
            self::LIGHTING => Yii::t('app/damage', 'lightning'),
            self::FIRE => Yii::t('app/damage', 'fire'),
            self::POISON => Yii::t('app/damage', 'poison'),
            self::COLD => Yii::t('app/damage', 'cold'),
            self::PSYCHIC => Yii::t('app/damage', 'psychic'),
            self::NO_DAMAGE => '-'
        ];
    }

    public static function getDamageType($dmg_type)
    {
        return (isset(self::getDamageTypes()[$dmg_type])) ? self::getDamageTypes()[$dmg_type] : $dmg_type;
    }


}
