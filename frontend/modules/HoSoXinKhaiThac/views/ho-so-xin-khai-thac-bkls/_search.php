<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\searchs\RegHoSoXinKhaiThacBklsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-ho-so-xin-khai-thac-bkls-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'reg_lo_rung_id') ?>

    <?= $form->field($model, 'dien_tich_khai_thac') ?>

    <?= $form->field($model, 'phuong_thuc_khai_thac_id') ?>

    <?= $form->field($model, 'tuoi_rung_khai_thac') ?>

    <?php // echo $form->field($model, 'so_cay_hien_tai') ?>

    <?php // echo $form->field($model, 'd13_cay_pho_bien') ?>

    <?php // echo $form->field($model, 'san_luong_du_kien') ?>

    <?php // echo $form->field($model, 'phuong_an_bao_ve_rung') ?>

    <?php // echo $form->field($model, 'trang_thai_id') ?>

    <?php // echo $form->field($model, 'reg_ho_so_xin_khai_thac_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('frontend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
