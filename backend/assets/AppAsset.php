<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
//        'DataTables/DataTables-1.10.18/css/dataTables.bootstrap.css',
        'DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css',
    ];
    public $js = [
//        'js/app.js',
        'DataTables/DataTables-1.10.18/js/jquery.dataTables.js',
        'DataTables/DataTables-1.10.18/js/dataTables.bootstrap.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
