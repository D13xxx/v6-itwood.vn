<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SysChuSoHuu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-chu-so-huu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ten')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trang_thai_id')->textInput() ?>

    <?= $form->field($model, 'nguoi_tao')->textInput() ?>

    <?= $form->field($model, 'ngay_tao')->textInput() ?>

    <?= $form->field($model, 'nguoi_sua')->textInput() ?>

    <?= $form->field($model, 'ngay_sua')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>