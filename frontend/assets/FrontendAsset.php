<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use common\assets\Html5shiv;
use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Frontend application asset
 */
class FrontendAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@frontend/web/bundle';

    /**
     * @var array
     */
    public $css = [
//        '/themes/css/animation.css',

        'https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,500',
        'http://fonts.googleapis.com/css?family=Montserrat:400,700',
        '/themes/css/mobile-menu.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css',
        '/themes/fonts/flaticon/flaticon.css',
        // 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
        '/css/frontend.css',
        '/themes/css/style.css',

    ];

    /**
     * @var array
     */
    public $js = [
        //'/app.js',

        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',
        '/themes/js/smoothscroll.js',
        '/themes/js/mobile-menu.js',
        //'https://maps.googleapis.com/maps/api/js',
        '/themes/js/scripts.js',
        'https://apis.google.com/js/platform.js',
        'https://static.addtoany.com/menu/page.js',
        'https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap',

        'http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js',
        'http://threejs.org/examples/js/libs/stats.min.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        Html5shiv::class,
    ];
}
