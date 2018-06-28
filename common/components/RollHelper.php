<?php

namespace common\components;

use Yii;

class RollHelper
{
    private static function _roll($count, $dice)
    {
        $result = 0;
        $c = 0;
        while ($c < $count) {
            $result += rand(1, $dice);
            $c++;
        }
        return $result;
    }

    public static function roll($roll_string)
    {
        $result = 0;
        $rollInfo = explode('+', $roll_string);
        foreach ($rollInfo as $roll) {
            if (strpos($roll, 'd') > 0)
                $result += self::rollDice($roll);
            else
                $result += $roll;
        }
        return $result;
    }

    private static function rollDice($roll_string)
    {
        $rollInfo = explode('d', $roll_string);
        return self::_roll($rollInfo[0], $rollInfo[1]);
    }


}
