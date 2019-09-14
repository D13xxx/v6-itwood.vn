<?php 
use yii\widgets\Menu;

?>
<div class="header-top visible-md visible-lg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <ul class="social-icon">
                    <li><a href="#" class="fa fa-facebook icon-social" aria-hidden="true"> </a></li>
                    <li><a href="#" class="fa fa-twitter icon-social" aria-hidden="true"> </a></li>
                    <li><a href="#" class="fa fa-pinterest-p icon-social" aria-hidden="true"> </a></li>
                    <li><a href="#" class="fa fa-google-plus icon-social" aria-hidden="true"> </a></li>
                    <li><a href="#" class="fa fa-linkedin icon-social" aria-hidden="true"> </a></li>

                </ul>
            </div>

            <div class="col-sm-12 col-md-8">
                <?php echo Menu::widget([
                    'options'=>['class'=>'top-contact pull-right'],
                    'items' => [
                        [
                            'options'=>['class'=>'phone'],
                            'template' => '<i class="fa fa-phone-square" aria-hidden="true"></i>+024-85-888-222',
                        ],
                        [
                            'options'=>['class'=>'email'],
                            'template' => '<i class="fa fa-envelope-square" aria-hidden="true"></i>support@itwood.vn',
                        ],
                    ],
                ]);?>
            </div>
        </div>
    </div>
</div>
