<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class PrivateAsset extends AssetBundle
{
    public $sourcePath = '@frontend/web/bundle';

    public $css = [
        '/private/css/bootstrap.min.css',
        '/private/css/bootstrap-responsive.min.css',
        '/private/css/fullcalendar.css',
        '/private/css/uniform.css',
        '/private/css/select2.css',
        '/private/css/maruti-style.css',
        '/private/css/maruti-media.css',
        '/private/css/datepicker.css'
    ];

    public $js = [
//        '/private/js/excanvas.min.js',
        '/private/js/jquery.min.js',
        '/private/js/jquery.ui.custom.js', 
        '/private/js/bootstrap.min.js',
//        '/private/js/jquery.flot.min.js',
//        '/private/js/jquery.flot.resize.min.js',
        '/private/js/jquery.peity.min.js',
        '/private/js/jquery.uniform.js',
        '/private/js/fullcalendar.min.js',
        '/private/js/select2.min.js',
        '/private/js/bootstrap-datepicker.js',
        '/private/js/maruti.js',
//        '/private/js/maruti.dashboard.js',
        '/private/js/maruti.chat.js',
        '/private/js/maruti.form_common.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
