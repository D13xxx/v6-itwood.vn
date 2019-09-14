<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoXinKhaiThac */

$this->title = Yii::t('frontend', 'Tạo hồ sơ xin khai thác');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Danh mục hồ sơ xin khai thác'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-ho-so-xin-khai-thac-create">

    <?= $this->render('_form', [
        'model' => $model,
//        'modelTrongRung'=>$modelTrongRung,
    ]) ?>

</div>
