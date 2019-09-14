<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RegChuTheHoGiaDinh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-chu-the-ho-gia-dinh-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ma')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noi_thuong_tru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tinh_thanh_id')->textInput() ?>

    <?= $form->field($model, 'quan_huyen_id')->textInput() ?>

    <?= $form->field($model, 'xa_phuong_id')->textInput() ?>

    <?= $form->field($model, 'so_cmtnd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ngay_cap')->textInput() ?>

    <?= $form->field($model, 'noi_cap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trang_thai_id')->textInput() ?>

    <?= $form->field($model, 'ngay_tao')->textInput() ?>

    <?= $form->field($model, 'nguoi_duyet')->textInput() ?>

    <?= $form->field($model, 'ngay_duyet')->textInput() ?>

    <?= $form->field($model, 'nguoi_sua')->textInput() ?>

    <?= $form->field($model, 'ngay_sua')->textInput() ?>

    <?= $form->field($model, 'loai_hinh_hoat_dong_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_dinh_kem')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'so_dien_thoai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
