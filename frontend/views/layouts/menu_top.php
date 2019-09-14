<?php 
use yii\widgets\Menu;

?>
<nav class="navbar m-menu navbar-default clear-fix">
    <div class="container clearfix">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://itwood.vn"><img class='logo-header' src="/themes/img/logo.png" alt=""></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse clear-fix" id="#navbar-collapse-1">
            <!--ul class=""-->
			<?php echo Menu::widget([
				'options'=>['class'=>'nav navbar-nav navbar-right main-nav'],
				'items' => [
					['label' => Yii::t('frontend', 'Giao dịch'), 'url' => 'http://itwood.vn/page/giao-dich'],
					['label' => Yii::t('frontend', 'Dịch vụ'), 'url' => 'http://itwood.vn/page/dich-vu'],
//					['label' => Yii::t('frontend', 'Văn bản luật'), 'url' => 'http://itwood.vn/van-ban-luat'],
					['label' => Yii::t('frontend', 'Truy xuất'), 'url' => ['/truy-xuat/index']],
					['label' => Yii::t('frontend', 'Liên hệ'), 'url' => 'http://itwood.vn/site/lien-he'],
                    [
                        'options'=>['class'=>'get-a-quote'],
                        'label' => Yii::t('frontend', 'Đăng ký'),
                        'url' => ['/dang-ky'], 'visible'=>Yii::$app->user->isGuest],
                    [
                        'options'=>['class'=>'get-a-login'],
                        'label' => Yii::t('frontend', 'Đăng nhập'),
                        'url' => ['/site/login'], 'visible'=>Yii::$app->user->isGuest],
                    [
                        'options'=>['class'=>'dropdown dropdown-toggle '],
                        'visible'=>!Yii::$app->user->isGuest,
                        'template' => '<a href="#" data-toggle="dropdown" >'.(Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->getPublicIdentity()).' <span><i class="fa fa-angle-down"></i></span></a>',
                        'submenuTemplate' => "\n<ul class='dropdown-menu dropdown-menu-right'>\n{items}\n</ul>\n",
                        'items'=>[
                            [
                                'label' => Yii::t('frontend', 'Giao diện làm việc'),
                                'url' => ['/ban-lam-viec'],
//                                'options'=>['class'=>'btn-block']
                            ],
                            [
                                'label' => Yii::t('frontend', 'Đăng xuất'),
                                'url' => ['/site/logout'],
                                'template' => '<a href="{url}" , data-method="post">{label}</a>',
//                                'options'=>['class'=>'btn-block']
                            ]
                        ]
                    ],
				],
			]);?>
            <?php echo Menu::widget([
                'options'=>['class'=>'top-contact pull-right'],
                'items' => [

                ],
            ]);?>
        </div>
        <!-- .navbar-collapse -->
    </div>
    <!-- .container -->
</nav>
