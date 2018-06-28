<?php
/**
 * Created by PhpStorm.
 * User: s_ponidelnik
 * Date: 19.05.18
 * Time: 0:32
 */

namespace common\components;

use Yii;
use yii\base\Component;

class Socket extends Component
{
    public $connections=[];
}