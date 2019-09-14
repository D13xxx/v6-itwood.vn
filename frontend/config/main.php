<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'ban-lam-viec' => [
            'class' => 'frontend\modules\Daskboard\Daskboard',
        ],
        'quyen-su-dung-dat-va-rung' => [
            'class' => 'frontend\modules\QuyenSuDungDatVaRung\Module',
        ],
        'ho-so-xin-khai-thac' => [
            'class' => 'frontend\modules\HoSoXinKhaiThac\Module',
        ],
        'ho-so-go' => [
            'class' => 'frontend\modules\HoSoGo\module',
        ],
        'giao-dich' =>[
            'class'=> 'frontend\modules\GiaoDich\module',
        ],
        'che-bien' =>[
            'class'=>'frontend\modules\CheBien\module',
        ],
        'chu-the' =>[
            'class'=>'frontend\modules\ChuThe\module',
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];
