<?php 
use yii\widgets\Menu;

?>

<footer class="footer">

<!--	--><?php //echo common\widgets\DbText::widget([
//            'key'=>'footer-widget-section',
//        ]) ?>

    <div class="copyright-section">
        <div class="container clearfix">
            <span class="copytext">Copyright &copy; 2018 | <a href="http://innogroup.vn">VAFS - VNFOREST</a></span>
			<?php echo Menu::widget([
				'options'=>['class'=>'list-inline pull-right'],
				'items' => [
					// Important: you need to specify url as 'controller/action',
					// not just as 'controller' even if default action is used.
//					['label' => Yii::t('frontend', 'Trang chủ'), 'url' => 'http://itwood.vn'],
					['label' => Yii::t('frontend', 'Giao dịch'), 'url' => 'http://itwood.vn/page/giao-dich'],
					['label' => Yii::t('frontend', 'Dịch vụ'), 'url' => 'http://itwood.vn/page/dich-vu'],
					['label' => Yii::t('frontend', 'Truy xuất'), 'url' => ['/truy-xuat/index']],
					['label' => Yii::t('frontend', 'Liên hệ'), 'url' => 'http://itwood.vn/site/lien-he'],
				],
			]);?>
        </div><!-- .container -->
    </div><!-- .copyright-section -->
</footer>
