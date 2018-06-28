<?php
namespace backend\assets;
use yii\web\AssetBundle;

class FullMapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/full_map.css',
    ];
    public $js = [
        'js/grab-to-pan.js-master/grab-to-pan.js',
        'js/fullmap.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}