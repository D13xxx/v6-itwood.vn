<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoXinKhaiThacBkls */

$this->title = Yii::t('frontend', 'Thêm chi tiết Hồ sơ đăng ký khai thác');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Danh mục hồ sơ xin khai thác'), 'url' => ['/ho-so-xin-khai-thac/ho-so-xin-khai-thac/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-ho-so-xin-khai-thac-bkls-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelHoSoDangKyKhaiThac'=>$modelHoSoDangKyKhaiThac
    ]) ?>

</div>
