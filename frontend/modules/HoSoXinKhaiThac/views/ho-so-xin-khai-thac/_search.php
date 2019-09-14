<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\searchs\RegHoSoXinKhaiThacSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-ho-so-xin-khai-thac-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dien_tich_khai_thac') ?>

    <?= $form->field($model, 'ngay_bat_dau') ?>

    <?= $form->field($model, 'ngay_ket_thuc') ?>

    <?= $form->field($model, 'chu_the_id') ?>

    <?php // echo $form->field($model, 'ngay_lap') ?>

    <?php // echo $form->field($model, 'trang_thai_id') ?>

    <?php // echo $form->field($model, 'nguoi_duyet_id') ?>

    <?php // echo $form->field($model, 'ngay_duyet') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('frontend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
