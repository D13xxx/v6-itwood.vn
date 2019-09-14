<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\searchs\RegChuTheHoGiaDinhSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-chu-the-ho-gia-dinh-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ma') ?>

    <?= $form->field($model, 'ten') ?>

    <?= $form->field($model, 'noi_thuong_tru') ?>

    <?= $form->field($model, 'tinh_thanh_id') ?>

    <?php // echo $form->field($model, 'quan_huyen_id') ?>

    <?php // echo $form->field($model, 'xa_phuong_id') ?>

    <?php // echo $form->field($model, 'so_cmtnd') ?>

    <?php // echo $form->field($model, 'ngay_cap') ?>

    <?php // echo $form->field($model, 'noi_cap') ?>

    <?php // echo $form->field($model, 'trang_thai_id') ?>

    <?php // echo $form->field($model, 'ngay_tao') ?>

    <?php // echo $form->field($model, 'nguoi_duyet') ?>

    <?php // echo $form->field($model, 'ngay_duyet') ?>

    <?php // echo $form->field($model, 'nguoi_sua') ?>

    <?php // echo $form->field($model, 'ngay_sua') ?>

    <?php // echo $form->field($model, 'loai_hinh_hoat_dong_id') ?>

    <?php // echo $form->field($model, 'file_dinh_kem') ?>

    <?php // echo $form->field($model, 'so_dien_thoai') ?>

    <?php // echo $form->field($model, 'email') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
