<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\XaPhuong */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="xa-phuong-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ma')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quan_huyen_id')->textInput() ?>

    <?= $form->field($model, 'tinh_thanh_id')->textInput() ?>

    <?= $form->field($model, 'trang_thai')->textInput() ?>

    <?= $form->field($model, 'is_delete')->textInput() ?>

    <?= $form->field($model, 'nguoi_xoa')->textInput() ?>

    <?= $form->field($model, 'ngay_xoa')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
