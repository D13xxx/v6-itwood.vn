<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\searchs\RegChuTheToChucSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-chu-the-to-chuc-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ma') ?>

    <?= $form->field($model, 'ten_to_chuc') ?>

    <?= $form->field($model, 'ten_thuong_mai') ?>

    <?= $form->field($model, 'ten_tieng_nuoc_ngoai') ?>

    <?php // echo $form->field($model, 'giay_dang_ky_kd') ?>

    <?php // echo $form->field($model, 'loai_hinh_hoat_dong_id') ?>

    <?php // echo $form->field($model, 'ma_so_thue') ?>

    <?php // echo $form->field($model, 'nguoi_dai_dien') ?>

    <?php // echo $form->field($model, 'so_cmtnd') ?>

    <?php // echo $form->field($model, 'ngay_cap') ?>

    <?php // echo $form->field($model, 'noi_cap') ?>

    <?php // echo $form->field($model, 'dia_chi_tru_so') ?>

    <?php // echo $form->field($model, 'website') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'so_dien_thoai') ?>

    <?php // echo $form->field($model, 'ngay_tao') ?>

    <?php // echo $form->field($model, 'nguoi_duyet') ?>

    <?php // echo $form->field($model, 'ngay_duyet') ?>

    <?php // echo $form->field($model, 'trang_thai_id') ?>

    <?php // echo $form->field($model, 'tinh_thanh_id') ?>

    <?php // echo $form->field($model, 'quan_huyen_id') ?>

    <?php // echo $form->field($model, 'xa_phuong_id') ?>

    <?php // echo $form->field($model, 'file_dinh_kem') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
