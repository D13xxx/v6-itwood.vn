<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoXinKhaiThacBkls */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-ho-so-xin-khai-thac-bkls-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reg_lo_rung_id')->textInput() ?>

    <?= $form->field($model, 'dien_tich_khai_thac')->textInput() ?>

    <?= $form->field($model, 'phuong_thuc_khai_thac_id')->textInput() ?>

    <?= $form->field($model, 'tuoi_rung_khai_thac')->textInput() ?>

    <?= $form->field($model, 'so_cay_hien_tai')->textInput() ?>

    <?= $form->field($model, 'd13_cay_pho_bien')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'san_luong_du_kien')->textInput() ?>

    <?= $form->field($model, 'phuong_an_bao_ve_rung')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trang_thai_id')->textInput() ?>

    <?= $form->field($model, 'reg_ho_so_xin_khai_thac_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
