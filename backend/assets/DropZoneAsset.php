<?php
namespace backend\assets;
use yii\web\AssetBundle;
/**
 * Asset bundle for DropZone Widget
 */
class DropZoneAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        "js/dropzone.js"
    ];
    public $css = [
        "css/dropzone.css"
    ];
    /**
     * @var array
     */
    public $publishOptions = [
        'forceCopy' => true
    ];
}