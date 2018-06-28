<?php

namespace common\widgets\items\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ItemsAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets/items/web';
    public $css = [
        'css/items.css',
    ];
    public $js = [
        'js/items.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
