<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\searchs\RegLoRungSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-lo-rung-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tieu_khu') ?>

    <?= $form->field($model, 'khoanh') ?>

    <?= $form->field($model, 'lo') ?>

    <?= $form->field($model, 'dia_chi') ?>

    <?php // echo $form->field($model, 'tinh_thanh_id') ?>

    <?php // echo $form->field($model, 'quan_huyen_id') ?>

    <?php // echo $form->field($model, 'xa_phuong_id') ?>

    <?php // echo $form->field($model, 'loai_rung_id') ?>

    <?php // echo $form->field($model, 'trang_thai_id') ?>

    <?php // echo $form->field($model, 'ma') ?>

    <?php // echo $form->field($model, 'nguoi_tao_id') ?>

    <?php // echo $form->field($model, 'ngay_tao') ?>

    <?php // echo $form->field($model, 'nguoi_sua_id') ?>

    <?php // echo $form->field($model, 'ngay_sua') ?>

    <?php // echo $form->field($model, 'nguoi_duyet_id') ?>

    <?php // echo $form->field($model, 'ngay_duyet') ?>

    <?php // echo $form->field($model, 'quyen_sdd_id') ?>

    <?php // echo $form->field($model, 'chu_the_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('frontend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
