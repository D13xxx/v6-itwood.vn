<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'DataTables/DataTables-1.10.18/css/dataTables.bootstrap.css',
        'DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css',
    ];
    public $js = [
        'DataTables/DataTables-1.10.18/js/jquery.dataTables.js',
        'DataTables/DataTables-1.10.18/js/dataTables.bootstrap.js',
        'js/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
