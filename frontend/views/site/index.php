<?php
use yii\grid\GridView;
use yii\helpers\Html;
$this->title =Yii::t('frontend','Trang chủ');
?>

<div class="slide">
    <?php
    if(count($modelBanner)>0){
        foreach ($modelBanner as $key => $value){ ?>
            <div class="slide1">
                <img src="<?= Yii::getAlias('@linkImages/uploads/website/banner/').$value->images?>" style="width: 1900px; height: 600px" alt=""/>
                <h5><?= $value->title?></h5>
            </div><!--end slide1-->
        <?php }
    } else { ?>
        <div class="slide1">
            <img src="images/slide.png" width="1920" height="773" alt=""/>
            <h5>Cái gì cũng "hiện đại hoá" - thì sẽ thành thảm hoạ</h5>
        </div>
    <?php }
    ?>
</div><!--end slide-->

<div class="gioithieu">
    <div class="scrollicon"><img src="/themes/itwood/images/icon_slide.png" width="54" height="54" alt=""/><span></span></div>
    <div class="maincontent">
        <h2>iTwood - truy xuất thông minh nguồn gốc lâm sản</h2>
        <p>Truy xuất và quản lý nguồn gốc gỗ hợp pháp là một yêu cầu nghiêm túc và chính đáng của người tiêu dùng vì mục đích phát triển nền lâm nghiệp bền vững và nói không với hàng hóa lâm sản gây mất rừng.</p>
        <ul>
            <li><img src="/themes/itwood/images/icon_ketnoi.png" width="200" height="200" alt=""/><b>Kết nối</b></li>
            <li><img src="/themes/itwood/images/icon_hiendai.png" width="200" height="200" alt=""/><b>Hiện đại</b></li>
            <li><img src="/themes/itwood/images/icon_minhbach.png" width="200" height="200" alt=""/><b>Minh bạch</b></li>
            <li><img src="/themes/itwood/images/icon_hieuqua.png" width="200" height="200" alt=""/><b>Hiệu quả</b></li>
        </ul>
    </div><!--end maincontent-->
</div><!--end gioithieu-->

<div class="loiich">
    <div class="maincontent">
        <h2>Lợi ích mang lại<span></span></h2>
        <ul>
            <li><i class="icon"><img src="/themes/itwood/images/icon_loiich.png" width="19" height="17" alt=""/></i>Gia tăng cơ hội thị trường của chủ rừng và tất cả các tác nhân trong chuỗi cung Gỗ 	&amp; Sản phẩm gỗ</li>
            <li><i class="icon"><img src="/themes/itwood/images/icon_loiich.png" width="19" height="17" alt=""/></i>Cung cấp thông tin và quy trình truy xuất đảm bảo tính hợp pháp của hàng hóa gỗ đến tay người tiêu dùng</li>
            <li><i class="icon"><img src="/themes/itwood/images/icon_loiich.png" width="19" height="17" alt=""/></i>Phòng ngừa và quản lý rủi ro thị trường với tất cả tác nhân tham gia hệ thống</li>
        </ul>
    </div><!--end maincontent-->
</div><!--end loiich-->

<div class="dichvu">
    <div class="maincontent">
        <h2><span></span>Dịch vụ của iTwood</h2>
        <ul>
            <span class="bgdv"></span>
            <span class="bgdv bgdv2"></span>
            <li><span>1</span>Cung cấp dịch vụ công tạo lập bằng chứng nguồn gốc gỗ hợp pháp</li>
            <li><span>2</span>Truy xuất nhanh – chính xác nguồn gốc gỗ hợp pháp, khách hàng sẽ có đủ mọi thông tin và bằng chứng liên quan.</li>
            <li><span>3</span>Tư vấn xây dựng chuỗi cung gỗ và sản phẩm gỗ hợp pháp</li>
            <li><span>4</span>Tư vấn xây dựng thương hiệu gỗ và sản phẩm gỗ cho địa phương và doanh nghiệp</li>
        </ul>
    </div><!--end maincontent-->
</div><!--end dichvu-->

<div class="doitac duantieubieu">
    <div class="maincontent">
        <h2><span></span>Các dự án tiêu biểu</h2>
        <marquee><ul>
                <li><img src="/themes/itwood/images/logo_1.png" width="111" height="114" alt=""/><span>FAO</span></li>
                <li><img src="/themes/itwood/images/logo2.png" width="111" height="114" alt=""/><span>HAWA</span></li>
                <li><img src="/themes/itwood/images/logo_1.png" width="111" height="114" alt=""/><span>FAO</span></li>
                <li><img src="/themes/itwood/images/logo2.png" width="111" height="114" alt=""/><span>HAWA</span></li>
                <li><img src="/themes/itwood/images/logo_1.png" width="111" height="114" alt=""/><span>FAO</span></li>
            </ul></marquee>
    </div><!--end maincontent-->
</div><!--end duantieubieu-->

<div class="doitac">
    <div class="maincontent">
        <h2><span></span>Đối tác của iTwood</h2>
        <marquee><ul>
                <li><img src="/themes/itwood/images/logo_1.png" width="111" height="114" alt=""/><span>FAO</span></li>
                <li><img src="/themes/itwood/images/logo2.png" width="111" height="114" alt=""/><span>HAWA</span></li>
                <li><img src="/themes/itwood/images/logo_1.png" width="111" height="114" alt=""/><span>FAO</span></li>
                <li><img src="/themes/itwood/images/logo2.png" width="111" height="114" alt=""/><span>HAWA</span></li>
                <li><img src="/themes/itwood/images/logo_1.png" width="111" height="114" alt=""/><span>FAO</span></li>
            </ul></marquee>
    </div><!--end maincontent-->
</div><!--end doitac-->