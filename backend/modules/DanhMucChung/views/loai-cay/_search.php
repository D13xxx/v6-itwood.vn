<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\searchs\SysLoaiCaySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-loai-cay-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ma') ?>

    <?= $form->field($model, 'ten') ?>

    <?= $form->field($model, 'ten_khoa_hoc') ?>

    <?= $form->field($model, 'nhom_cay_trong_id') ?>

    <?php // echo $form->field($model, 'tuoi_toi_thieu') ?>

    <?php // echo $form->field($model, 'trang_thai') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
