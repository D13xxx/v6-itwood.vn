<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoXinKhaiThacTrongRung */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-ho-so-xin-khai-thac-trong-rung-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reg_lo_rung_id')->textInput() ?>

    <?= $form->field($model, 'loai_cay_trong_id')->textInput() ?>

    <?= $form->field($model, 'phuong_thuc_trong_id')->textInput() ?>

    <?= $form->field($model, 'nam_trong')->textInput() ?>

    <?= $form->field($model, 'loai_von_dau_tu_id')->textInput() ?>

    <?= $form->field($model, 'chu_so_huu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reg_ho_so_xin_khai_thac_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
