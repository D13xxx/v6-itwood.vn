<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/19/2019
 * Time: 9:18 AM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class ItwoodAsset extends AssetBundle
{
    public $sourcePath = '@frontend/web/bundle';
    public $baseUrl = '@web';
    public $css = [
        '/themes/itwood/styles/slick.css',
        '/themes/itwood/styles/slick-theme.css',
        '/themes/itwood/styles/basicStyle.css',
        '/themes/itwood/styles/responsiveStyle.css',
    ];

    public $js = [
        '/themes/itwood/js/jquery-1.9.1.min.js',
        '/themes/itwood/js/jquery.easing.1.3.js',
        '/themes/itwood/js/slick.min.js',
        '/themes/itwood/js/myScript.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}