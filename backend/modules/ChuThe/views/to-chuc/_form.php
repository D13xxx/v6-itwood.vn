<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RegChuTheToChuc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-chu-the-to-chuc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ma')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_to_chuc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_thuong_mai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_tieng_nuoc_ngoai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'giay_dang_ky_kd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loai_hinh_hoat_dong_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ma_so_thue')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nguoi_dai_dien')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'so_cmtnd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ngay_cap')->textInput() ?>

    <?= $form->field($model, 'noi_cap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dia_chi_tru_so')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'so_dien_thoai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ngay_tao')->textInput() ?>

    <?= $form->field($model, 'nguoi_duyet')->textInput() ?>

    <?= $form->field($model, 'ngay_duyet')->textInput() ?>

    <?= $form->field($model, 'trang_thai_id')->textInput() ?>

    <?= $form->field($model, 'tinh_thanh_id')->textInput() ?>

    <?= $form->field($model, 'quan_huyen_id')->textInput() ?>

    <?= $form->field($model, 'xa_phuong_id')->textInput() ?>

    <?= $form->field($model, 'file_dinh_kem')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
