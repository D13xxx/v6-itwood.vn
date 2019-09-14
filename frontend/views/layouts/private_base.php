<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use common\models\User;
use yii\widgets\Menu;
use kartik\nav\NavX;
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/private_clear.php')
?>

    <!--Header-part-->
    <div id="header">
        <h1></h1>
    </div>
    <!--close-Header-part-->

    <!--top-Header-menu-->
    <div id="user-nav" class="navbar-red navbar-inverse">
        <ul class="nav">
            <li class="" ><a title="" href="#"><i class="icon icon-user"></i> <span class="text">Profile</span></a></li>
            <li class=""><a title="" href="login.html"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
        </ul>
    </div>

    <!--close-top-Header-menu-->

    <div id="sidebar">

        <?php
        echo Menu::widget([
            'encodeLabels'=>false,
            'items' => [
                [
                    'label' => '<i class="icon icon-home"></i><span>'.Yii::t('frontend','Trang chủ').'</span>',
                    'url' => ['/ban-lam-viec'],
                    'active'=>Yii::$app->controller->action->id=='test'
                ],
                [
                    'label' => '<i class="icon icon-user"></i><span>'.Yii::t('frontend','Chủ thể').'</span> <span><i class="icon icon-chevron-down"></i></span>',
                    'url' => '',
                    'items'=>[
                        ['label'=>'<hr>'],
                        [
                            'label'=>Yii::t('frontend','Danh sách chủ thể'),
                            'url'=>['/reg-chu-the/index'],
//                            'active'=>(Yii::$app->module->id=='reg-chu-the' && Yii::$app->controller->action->id=='index')
                        ],
                        ['label'=>'<hr>'],
                        [
                            'label'=>Yii::t('frontend','Tạo chủ thể mới'),
                            'url'=>['/reg-chu-the/create'],
                            'active'=>Yii::$app->controller->action->id=='create'
                        ],
                        ['label'=>'<hr>'],
                        [
                            'label'=>Yii::t('frontend','Chọn chủ thể làm việc'),
                            'url'=>['/reg-chu-the/chon-chu-the'],
                            'active'=>Yii::$app->controller->action->id=='chon-chu-the'
                        ],
                    ],
                    'active'=>Yii::$app->controller->id=='reg-chu-the',
                ],
                [
                    'label' => '<i class="icon icon-leaf"></i><span>'.Yii::t('frontend','Thông tin lô rừng').'</span> <span><i class="icon icon-chevron-down"></i></span>',
                    'url' => '',
                    'options'=>['class'=>'submenu'],
                    'items' => [
                        ['label'=>'<hr>'],
                        [
                            'label' => Yii::t('frontend','Thông tin quyền sử dụng đất'),
                            'url' => ['/quyen-su-dung-dat-va-rung/quyen-su-dung-dat-va-rung/'],
                            'active'=>(Yii::$app->controller->action->id=='index' && Yii::$app->controller->id=='reg-qsd-dat')
                        ],
                        ['label'=>'<hr>'],
                        [
                            'label' => Yii::t('frontend','Thông tin lô rừng'),
                            'url' => ['/quyen-su-dung-dat-va-rung/quyen-su-dung-dat-va-rung/'],
                            'active'=>(Yii::$app->controller->action->id=='index' && Yii::$app->controller->id=='reg-lo-rung-trong'),
                        ],
//                        ['label'=>'<hr>'],
//                        [
//                            'label' => Yii::t('frontend','Thêm Quyền sử dụng đất mới'),
//                            'url' => ['/quyen-su-dung-dat-va-rung/quyen-su-dung-dat-va-rung/create'],
//                            'active'=>Yii::$app->controller->action->id=='create'
//                        ],
                    ],
                    'active'=>(Yii::$app->controller->id=='reg-qsd-dat' || Yii::$app->controller->id=='reg-lo-rung-trong')
                ],
                [
                    'label'=>'<i class=""></i><span>'.Yii::t('frontend','Hồ sơ xin khai thác').'</span> <span><i class="icon icon-chevron-down"></i></span>',
                    'url'=>'',
                    'options'=>['class'=>'submenu'],
                    'items'=>[
                        ['label'=>'<hr>'],
                        [
                            'label'=>Yii::t('frontend','Danh sách hồ sơ mới'),
                            'url'=>['/reg-ho-so-khai-thac/ho-so-moi'],
                            'active'=>Yii::$app->controller->action->id=='ho-so-moi',
                        ],
                        ['label'=>'<hr>'],
                        [
                            'label'=> Yii::t('frontend','Danh sách hồ sơ đã duyệt'),
                            'url'=>['/reg-ho-so-khai-thac/ho-so-da-duyet'],
                            'active'=>Yii::$app->controller->action->id=='ho-so-da-duyet'
                        ],
                        ['label'=>'<hr>'],
                        [
                            'label'=>Yii::t('frontend','Tạo hò sơ khai thác mới'),
                            'url'=>['/reg-ho-so-khai-thac/create'],
                            'active'=>Yii::$app->controller->action->id=='create'
                        ],
                        ['label'=>'<hr>'],
                        [
                            'label'=>Yii::t('frontend','Danh sách hồ sơ đã chuyển đổi'),
                            'url'=>['/reg-ho-so-khai-thac/ho-so-da-chuyen-doi'],
                            'active'=>Yii::$app->controller->action->id=='ho-so-da-chuyen-doi'
                        ]
                    ]
                ],
                [
                    'label'=>'<i class=""></i><span>'.Yii::t('frontend','Hồ sơ Gỗ').'</span> <span><i class="icon icon-chevron-down"></i></span>',
                    'url'=>'',
                    'options'=>['class'=>'submenu'],
                    'items'=>[
                        ['label'=>'<hr>'],
                        [
                            'label'=>Yii::t('frontend','Danh sách hồ sơ mới'),
                            'url'=>['/ho-so-go/ho-so-go/ho-so-moi'],
                            'active'=>Yii::$app->controller->action->id=='ho-so-moi',
                        ],
                        ['label'=>'<hr>'],
                        [
                            'label'=> Yii::t('frontend','Danh sách hồ sơ đã duyệt'),
                            'url'=>['/ho-so-go/ho-so-go/ho-so-da-duyet'],
                            'active'=>Yii::$app->controller->action->id=='ho-so-da-duyet'
                        ],
                        ['label'=>'<hr>'],
                        [
                            'label'=>Yii::t('frontend','Tạo hò sơ gỗ mới'),
                            'url'=>['/reg-ho-so-go/create'],
                            'active'=>Yii::$app->controller->action->id=='create'
                        ],
                        ['label'=>'<hr>'],
                        [
                            'label'=>Yii::t('frontend','Danh sách hồ sơ đã chuyển đổi'),
                            'url'=>['/reg-ho-so-go/ho-so-da-chuyen-doi'],
                            'active'=>Yii::$app->controller->action->id=='ho-so-da-chuyen-doi'
                        ],
                    ]
                ],
                [
                    'label'=>'<i class=""></i><span>'.Yii::t('frontend','Giao dịch và chế biến').'</span> <span><i class="icon icon-chevron-down"></i></span>',
                    'url'=>'',
                    'options'=>['class'=>'submenu'],
                    'items'=>[
                        ['label'=>'<hr>'],
                        [
                            'label'=>Yii::t('frontend','Giao dịch Rừng').'<span class="pull-right"><i class="icon icon-chevron-right"></i></span>',
                            'options'=>['class'=>'my-dropdown-submenu submenu'],
                            'url'=>'#',
                            'template' => '<a href="{url}">{label}</a>',
                            'items'=>[
                                [
                                    'label'=>'Bán rừng',
                                    'url'=>['/reg-giao-dich/ban-rung'],
                                    'active'=>Yii::$app->controller->action->id=='ban-rung'
                                ],
                                [
                                    'label'=>'Mua Rừng',
                                    'url'=>['reg-giao-dich/mua-rung'],
                                    'active'=>Yii::$app->controller->action->id=='mua-rung'
                                ]
                            ],
                            'submenuTemplate' => "\n<ul class='my-dropdown-menu' >\n{items}\n</ul>\n",
                        ],
                        ['label'=>'<hr>'],
                        [
                            'label'=> Yii::t('frontend','Giao dịch hồ sơ Gỗ').'<span class="pull-right"><i class="icon icon-chevron-right"></i></span>',
                            'options'=>['class'=>'my-dropdown-submenu submenu'],
                            'url'=>'#',
                            'template' => '<a href="{url}">{label}</a>',
                            'items'=>[
                                [
                                    'label'=>'Bán hồ sơ gỗ',
                                    'url'=>['/reg-giao-dich/ban-ho-so-go'],
                                    'active'=>Yii::$app->controller->action->id=='ban-ho-so-go'
                                ],
                                [
                                    'label'=>'Mua Hồ sơ gỗ',
                                    'url'=>['/reg-giao-dich/mua-ho-so-go'],
                                    'active'=>Yii::$app->controller->action->id=='mua-ho-so-go'
                                ]
                            ],
                            'submenuTemplate' => "\n<ul class='my-dropdown-menu' >\n{items}\n</ul>\n",
                        ],
                        ['label'=>'<hr>'],
                        [
                            'label'=> Yii::t('frontend','Chế biến hồ sơ gỗ').'<span class="pull-right"><i class="icon icon-chevron-right"></i></span>',
                            'options'=>['class'=>'my-dropdown-submenu submenu'],
                            'url'=>'#',
                            'template' => '<a href="{url}">{label}</a>',
                            'items'=>[
                                [
                                    'label'=>'Tách hồ sơ gỗ',
                                    'url'=>['/reg-che-bien/tach-ho-so-go'],
                                    'active'=>Yii::$app->controller->action->id=='tach-ho-so-go'
                                ],
                                [
                                    'label'=>'Ghép Hồ sơ gỗ',
                                    'url'=>['/reg-che-bien/ghep-ho-so-go'],
                                    'active'=>Yii::$app->controller->action->id=='ghep-ho-so-go'
                                ]
                            ],
                            'submenuTemplate' => "\n<ul class='my-dropdown-menu' >\n{items}\n</ul>\n",
                        ],
                    ]
                ]
            ],
        ])?>

    </div>
    <div class="container col-sm-12" style="padding: 50px">
        <?php echo $content ?>
    </div>


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endContent() ?>

