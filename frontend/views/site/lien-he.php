<?php
$this->title = Yii::t('frontend','Liên hệ');
?>

<section class="single-page-title single-page-title-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><?= Yii::t('frontend','Liên hệ với chúng tôi') ?></h2>
            </div>
        </div>
    </div>
</section>
<!-- .page-title -->
<!-- .page-title -->

<section class="our-location">
    <div class="container">
        <div id="googleMap">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3722.7942941098595!2d105.7758375150264!3d21.08087658597017!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134553446dea549%3A0x872182e2015e2235!2zNDYgxJDGsOG7nW5nIMSQ4bupYyBUaOG6r25nLCDEkOG7qWMgVGjhuq9uZywgVOG7qyBMacOqbSwgSMOgIE7hu5lpLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1535453145633" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
</section>

<section class="contact-detail gray-bg">
    <div class="container text-left">
        <div class="row">
            <div class="col-md-4">
                <div class="promo-block-wrapper clearfix">
                    <div class="promo-icon promo-icon-blue">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="promo-content">
                        <h3><?php echo Yii::t('frontend','Trụ sở')?></h3>
                        <address>
                            Số 46 - Phường Đức Thắng <br>
                            Quận Bắc Từ Liêm - Hà Nội
                        </address>
                    </div>
                </div><!-- /.promo-block-wrapper -->
            </div>

            <div class="col-md-4">
                <div class="promo-block-wrapper clearfix">
                    <div class="promo-icon promo-icon-yellow">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="promo-content">
                        <h3><?= Yii::t('frontend','Số điện thoại')?></h3>
                        <address>
                            <abbr title="Phone"><?= Yii::t('frontend','Cố định')?>:</abbr> 024-85-888-222<br>
                            <abbr title="Phone"><?= Yii::t('frontend','Di động')?>:</abbr> 024-85-888-222
                        </address>
                    </div>
                </div><!-- /.promo-block-wrapper -->
            </div>

            <div class="col-md-4">
                <div class="promo-block-wrapper clearfix">
                    <div class="promo-icon promo-icon-green">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="promo-content">
                        <h3><?= Yii::t('frontend','Email iên hệ')?></h3>
                        <address>
                            <a href="mailto:#">hotro@innogroup.vn</a><br>
                            <a href="#">www.innogroup.vn</a>
                        </address>
                    </div>
                </div><!-- /.promo-block-wrapper -->
            </div>
        </div><!-- /.row -->
    </div>
</section> <!-- contact-detail -->



<section class="contact-section">
    <div class="container">
        <div class="section-title text-center">
            <h2>Nếu có bất kỳ câu hỏi nào vui lòng gọi điện cho chúng tôi hoặc gửi email,<br>
                Vui lòng điền đầy đủ thông tin và câu hỏi của bạn.</h2>
        </div>

        <div class="contact-form mt-50">
            <form action="">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nameTwo" class="sr-only"><?= Yii::t('frontend','Họ tên')?></label>
                            <input type="text" class="form-control" required="" id="nameTwo" placeholder="Họ tên">
                        </div>

                        <div class="form-group">
                            <label for="emailTwo" class="sr-only"><?= Yii::t('frontend','Email')?></label>
                            <input type="email" class="form-control" required="" id="emailTwo" placeholder="Địa chỉ email">
                        </div>

                        <div class="form-group">
                            <label for="phone" class="sr-only">Điện thoại</label>
                            <input type="email" class="form-control" required="" id="phone" placeholder="Số điện thoại">
                        </div>
                    </div> <!-- col-md-4 -->

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="messageTwo" class="sr-only"><?= Yii::t('frontend','Nội dung')?></label>
                            <textarea class="form-control" required="" rows="7" placeholder="Nội dung"></textarea>
                        </div>
                    </div> <!-- col-md-8 -->
                </div><!-- /.row-->

                <button type="submit" class="btn btn-primary btn-lg pull-right"><?= Yii::t('frontend','Gửi yêu cầu liên hệ')?></button>
            </form>
        </div> <!-- contact-form -->
    </div>
</section> <!-- contact-section -->