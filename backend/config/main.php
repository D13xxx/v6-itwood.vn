<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'rbac' => [
            'class' => 'mdm\admin\Module',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    /* 'userClassName' => 'app\models\User', */
                    'idField' => 'id',
                    'usernameField' => 'username',
                ],
            ],
            'layout' => 'left-menu',
            'mainLayout' => '@app/views/layouts/main.php',
            'as access'=>[
                'class'=>'mdm\admin\components\AccessControl',
                'allowActions'=>['SupperAdmin']
            ]
        ],
        'pdfjs' => [
            'class' => '\yii2assets\pdfjs\Module',
        ],
//        'treemanager' =>  [
//            'class' => '\kartik\tree\Module',
////            'treeStructure'=>[
////                'treeAttribute'=>
////            ]
//            // other module settings, refer detailed documentation
//        ],
        'danh-muc-chung' => [
            'class' => 'backend\modules\DanhMucChung\Module',
            'as access'=>[
                'class'=>'mdm\admin\components\AccessControl',
                'allowActions'=>['SupperAdmin','Admin']
            ]
        ],
        'dia-danh-hanh-chinh' => [
            'class' => 'backend\modules\DiaDanhHanhChinh\Module',
            'as access'=>[
                'class'=>'mdm\admin\components\AccessControl',
                'allowActions'=>['SupperAdmin','Admin']
            ]
        ],
        'chu-the'=>[
            'class'=>'backend\modules\ChuThe\Module',
            'as access'=>[
                'class'=>'mdm\admin\components\AccessControl',
                'allowActions'=>['UBNDXA','UBNDHUYEN','HATKIEMLAM','CHICUCKIEMLAM','TONGCUCKIEMLAM','Admin','SupperAdmin']
            ]
        ],
        'quan-ly-lo-rung' => [
            'class' => 'backend\modules\QuanLyLoRung\Module',
            'as access'=>[
                'class'=>'mdm\admin\components\AccessControl',
                'allowActions'=>['UBNDXA','UBNDHUYEN','HATKIEMLAM','CHICUCKIEMLAM','TONGCUCKIEMLAM','Admin','SupperAdmin']
            ]
        ],
        'dang-ky-khai-thac' => [
            'class' => 'backend\modules\DangKyKhaiThac\module',
            'as access'=>[
                'class'=>'mdm\admin\components\AccessControl',
                'allowActions'=>['UBNDXA','UBNDHUYEN','HATKIEMLAM','CHICUCKIEMLAM','TONGCUCKIEMLAM','Admin','SupperAdmin']
            ]
        ],
        'ho-so-go'=>[
            'class'=>'backend\modules\HoSoGo\module',
            'as access'=>[
                'class'=>'mdm\admin\components\AccessControl',
                'allowActions'=>['HATKIEMLAM','CHICUCKIEMLAM','TONGCUCKIEMLAM','Admin','SupperAdmin']
            ]
        ],
        'user'=>[
            'class'=>'backend\modules\User\module',
            'as access'=>[
                'class'=>'mdm\admin\components\AccessControl',
                'allowActions'=>['SupperAdmin','Admin']
            ]
        ],
        'content' => [
            'class' => backend\modules\content\Module::className(),
            'as access'=>[
                'class'=>'mdm\admin\components\AccessControl',
                'allowActions'=>['SupperAdmin','QUANLYWEBSITE','Admin']
            ]
        ],
        'widget' => [
            'class' => backend\modules\widget\Module::className(),
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
