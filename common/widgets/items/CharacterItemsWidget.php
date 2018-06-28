<?php

namespace common\widgets\items;
class CharacterItemsWidget extends \yii\bootstrap\Widget
{
    public $items;

    public function run()
    {
        return $this->render('index', ['items'=>$this->items]);
    }
}