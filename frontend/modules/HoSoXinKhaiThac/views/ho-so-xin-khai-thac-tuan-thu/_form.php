<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoXinKhaiThacTuanThu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-ho-so-xin-khai-thac-tuan-thu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reg_ho_so_xin_khai_thac_id')->textInput() ?>

    <?= $form->field($model, 'reg_trach_nhiem_tuan_thu_id')->textInput() ?>

    <?= $form->field($model, 'gia_tri')->textInput() ?>

    <?= $form->field($model, 'file_dinh_kem')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reg_lo_rung_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
