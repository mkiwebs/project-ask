<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class SummernoteAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/summernote-0.8.8/summernote.css',
        "css/bootstrap.min.css",
    ];
    public $js = [
    //"jquery/dist/jquery.js",
    "js/bootstrap.min.js",
    'js/summernote_specific.js',
    //'//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js',
    'plugins/summernote-0.8.8/summernote.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
