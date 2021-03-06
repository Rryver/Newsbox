<?php


namespace app\modules\posts\assets;


use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class PostsAssets extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = __DIR__;
        parent::init();
    }

    public $js = [
        'js/main.js',
    ];

    public $css = [
        'css/style.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}