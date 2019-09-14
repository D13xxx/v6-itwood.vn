<?php 
use yii\widgets\Menu;

?>
<div class="uc-mobile-menu uc-mobile-menu-effect">
    <button type="button" class="close" aria-hidden="true" data-toggle="offcanvas"
            id="uc-mobile-menu-close-btn">&times;</button>
    <div>
        <div>
		<?php echo Menu::widget([
				'options'=>['id'=>'menu'],
				'items' => [
					['label' => Yii::t('frontend', 'Trang chủ'), 'url' => 'http://itwood.vn'],
					['label' => Yii::t('frontend', 'Giao dịch'), 'url' => 'http://itwood.vn/page/giao-dich'],
					['label' => Yii::t('frontend', 'Dịch vụ'), 'url' => 'http://itwood.vn/page/dich-vu'],
					['label' => Yii::t('frontend', 'Truy xuất'), 'url' => ['/truy-xuat']],
					['label' => Yii::t('frontend', 'Liên hệ'), 'url' => 'http://itwood.vn/site/lien-he'],
				],
			]);?>           
        </div>
    </div>
</div>