<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="banner1" style="width: auto; height: 120px">
        <?= Html::img('@web/private/img/banner1.jpg',['style'=>'height: 120px; width: 100%'])?>
    </div>
    <?php
	if(!Yii::$app->user->isGuest){
	echo \kartik\nav\NavX::widget([
        'options'=>['class'=>'nav nav-pills my-nav'],
        'encodeLabels'=>false,
        'items' => [
            [
                'label'=>'Thoát (' . Yii::$app->user->identity->fullname . ')',
                'url'=>['/site/logout'],
                'options'=>['class'=>'pull-right'],
                'linkOptions'=>['data-method' => 'post']
            ],
            [
                'label' => '<i class="icon icon-home"></i><span>'.Yii::t('frontend','Trang chủ').'</span>',
                'url' => ['/ban-lam-viec'],
                'active'=>Yii::$app->controller->action->id=='test'
            ],
            [
                'label' => '<i class="icon icon-user"></i><span>'.Yii::t('frontend','Chủ thể').'</span> <span><i class="icon icon-chevron-down"></i></span>',
                'url' => '',
                'items'=>[
                    [
                        'label'=>Yii::t('frontend','Thông tin chủ thể'),
                        'url'=>['/chu-the/thong-tin'],
                        'active'=>(Yii::$app->controller->action->id=='index' && Yii::$app->module=='reg-chu-the')
                    ],
                    '<li class="divider"></li>',
                    [
                        'label'=>Yii::t('frontend','Đổi mật khẩu'),
                        'url'=>['/chu-the/thong-tin/doi-mat-khau'],
                        'active'=>Yii::$app->controller->action->id=='create'
                    ],
                ],
                'active'=>Yii::$app->controller->id=='reg-chu-the',
            ],
            [
                'label' => '<i class="icon icon-leaf"></i><span>'.Yii::t('frontend','Thông tin lô rừng').'</span> <span><i class="icon icon-chevron-down"></i></span>',
                'url' => '',
                'items' => [
                    [
                        'label' => Yii::t('frontend','Thông tin quyền sử dụng đất'),
                        'url' => ['/quyen-su-dung-dat-va-rung/quyen-su-dung-dat-va-rung/'],
                        'active'=>(Yii::$app->controller->action->id=='index' && Yii::$app->controller->id=='reg-qsd-dat')
                    ],
                    '<li class="divider"></li>',
                    [
                        'label' => Yii::t('frontend','Thông tin lô rừng'),
                        'url' => ['/quyen-su-dung-dat-va-rung/lo-rung/'],
                        'active'=>(Yii::$app->controller->action->id=='index' && Yii::$app->controller->id=='reg-lo-rung-trong'),
                    ],
//                    '<li class="divider"></li>',
//                    [
//                        'label' => Yii::t('frontend','Thêm Quyền sử dụng đất mới'),
//                        'url' => ['/quyen-su-dung-dat-va-rung/quyen-su-dung-dat-va-rung/create'],
//                        'active'=>Yii::$app->controller->action->id=='create'
//                    ],
                ],
                'active'=>(Yii::$app->module =='quyen-su-dung-dat-va-rung')
            ],
            [
                'label'=>'<i class=""></i><span>'.Yii::t('frontend','Hồ sơ đăng ký khai thác').'</span> <span><i class="icon icon-chevron-down"></i></span>',
                'url'=>'',
                'options'=>['class'=>'submenu'],
                'items'=>[
                    [
                        'label'=>Yii::t('frontend','Thông tin hồ sơ đăng ký khai thác'),
                        'url'=>['/ho-so-xin-khai-thac/ho-so-xin-khai-thac'],
                        'active'=>Yii::$app->controller->action->id=='ho-so-moi',
                    ],
                    '<li class="divider"></li>',
                    [
                        'label'=> Yii::t('frontend','Thông tin hồ sơ đã duyệt'),
                        'url'=>['/ho-so-xin-khai-thac/ho-so-xin-khai-thac/da-duyet'],
                        'active'=>Yii::$app->controller->action->id=='da-duyet'
                    ],
//                    '<li class="divider"></li>',
//                    [
//                        'label'=>Yii::t('frontend','Tạo Hồ sơ đăng ký khai thác mới'),
//                        'url'=>['/ho-so-xin-khai-thac/ho-so-xin-khai-thac/create'],
//                        'active'=>Yii::$app->controller->action->id=='create'
//                    ],
                ]
            ],
            [
                'label'=>'<i class=""></i><span>'.Yii::t('frontend','Hồ sơ Gỗ').'</span> <span><i class="icon icon-chevron-down"></i></span>',
                'url'=>'',
                'options'=>['class'=>'submenu'],
                'items'=>[
                    [
                        'label'=>Yii::t('frontend','Danh sách hồ sơ mới'),
                        'url'=>['/ho-so-go/ho-so-go/ho-so-moi'],
                        'active'=>Yii::$app->controller->action->id=='ho-so-moi',
                    ],
                    '<li class="divider"></li>',
                    [
                        'label'=> Yii::t('frontend','Danh sách hồ sơ đã duyệt'),
                        'url'=>['/ho-so-go/ho-so-go/ho-so-da-duyet'],
                        'active'=>Yii::$app->controller->action->id=='ho-so-da-duyet'
                    ],
//                    '<li class="divider"></li>',
//                    [
//                        'label'=>Yii::t('frontend','Tạo hồ sơ gỗ mới'),
//                        'url'=>['/ho-so-go/ho-so-go/create'],
//                        'active'=>Yii::$app->controller->action->id=='create'
//                    ],
                ]
            ],
            [
                'label'=>'<i class=""></i><span>'.Yii::t('frontend','Giao dịch và chế biến').'</span> <span><i class="icon icon-chevron-down"></i></span>',
                'url'=>'',
                'options'=>['class'=>'submenu'],
                'items'=>[
                    [
                        'label'=>Yii::t('frontend','Mua bán Rừng').'<span class="pull-right"><i class="icon icon-chevron-right"></i></span>',
                        'url'=>'#',
                        'template' => '<a href="{url}">{label}</a>',
                        'items'=>[
                            [
                                'label'=>'Bán rừng',
                                'url'=>['/giao-dich/giao-dich/ban-rung'],
                                'active'=>Yii::$app->controller->action->id=='ban-rung'
                            ],
                            '<li class="divider"></li>',
                            [
                                'label'=>'Mua Rừng',
                                'url'=>['/giao-dich/giao-dich/mua-rung'],
                                'active'=>Yii::$app->controller->action->id=='mua-rung'
                            ]
                        ],
                    ],
                    '<li class="divider"></li>',
                    [
                        'label'=> Yii::t('frontend','Giao dịch hồ sơ Gỗ').'<span class="pull-right"><i class="icon icon-chevron-right"></i></span>',
                        'url'=>'#',
                        'template' => '<a href="{url}">{label}</a>',
                        'items'=>[
                            [
                                'label'=>'Bán hồ sơ gỗ',
                                'url'=>['/giao-dich/giao-dich/ban-ho-so-go'],
                                'active'=>Yii::$app->controller->action->id=='ban-ho-so-go'
                            ],
                            '<li class="divider"></li>',
                            [
                                'label'=>'Mua Hồ sơ gỗ',
                                'url'=>['/giao-dich/giao-dich/mua-ho-so-go'],
                                'active'=>Yii::$app->controller->action->id=='mua-ho-so-go'
                            ]
                        ],
                    ],
                    '<li class="divider"></li>',
                    [
                        'label'=> Yii::t('frontend','Chế biến hồ sơ gỗ').'<span class="pull-right"><i class="icon icon-chevron-right"></i></span>',
                        'url'=>'#',
                        'template' => '<a href="{url}">{label}</a>',
                        'items'=>[
                            [
                                'label'=>'Tách hồ sơ gỗ',
                                'url'=>['/che-bien/tach-ho-so-go'],
                                'active'=>Yii::$app->controller->action->id=='tach-ho-so-go'
                            ],
                            '<li class="divider"></li>',
                            [
                                'label'=>'Ghép Hồ sơ gỗ',
                                'url'=>['/che-bien/ghep-ho-so-go'],
//                                'url'=>'#',
                                'active'=>Yii::$app->controller->action->id=='ghep-ho-so-go'
                            ]
                        ],
                    ],
                ]
            ]
        ],
    ]);
	}
    
    ?>
    <div class="col-sm-12">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $this->render('private_owner.php')?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">COPYRIGHT&copy; 2018 | VAFS - VNFOREST</p>

        <p class="pull-right">Phát triển bởi: FREC - INNOGROUP</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
