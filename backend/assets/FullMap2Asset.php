<?php
namespace backend\assets;
use yii\web\AssetBundle;

class FullMap2Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/full_map.css',
    ];
    public $js = [
        'js/grab-to-pan.js-master/grab-to-pan.js',
        'js/jquery.transform2d.js',
        'js/jquery.scrollTo.min.js',
        'js/fullmap2.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}