<?php
/**
 * @copyright Copyright (c) 2013-2018
 * @link http://ovicko.com
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace backend\assets;

use yii\web\AssetBundle;

class TinyMceAsset extends AssetBundle
{
    public $sourcePath = '@vendor/tinymce/js/tinymce';

    public $js = [
        'tinymce.min.js'
    ];
}