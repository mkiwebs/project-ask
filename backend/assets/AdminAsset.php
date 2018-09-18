<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/AdminLTE.min.css',
        'css/AdminLTE.css',
        'css/skins/_all-skins.min.css',
        'plugins/daterangepicker/daterangepicker-bs3.css',
        '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
    ];
    public $js = [
    'js/app.min.js',
    'js/jquery-ui.min.js',
    'plugins/daterangepicker/daterangepicker.js',
    'plugins/daterangepicker/moment.min.js',
    'https://code.jquery.com/jquery-migrate-3.0.0.min.js',
    'js/jquery.slimscroll.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
