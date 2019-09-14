<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/_clear.php')
?>
    <div id="main-wrapper">
        <div class="uc-mobile-menu-pusher">
            <div class="content-wrapper">
                <!-- Header Top -->
                <?= $this->render('top_header')?>
                <!-- .navbar-top -->
                <?= $this->render('menu_top')?>
                <!-- .nav -->
                <?php echo $content;?>

                <?= $this->render('footer')?>
                <!-- .footer -->
            </div>
            <!-- .content-wrapper -->
        </div>
        <!-- .uc-mobile-menu-pusher -->
        <?= $this->render('menu_mobi')?>
        <!-- .uc-mobile-menu -->

    </div>
<?php $this->endContent() ?>