<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\searchs\SysTrachNhiemTuanThuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-trach-nhiem-tuan-thu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ten') ?>

    <?= $form->field($model, 'loai_hinh_chu_the_id') ?>

    <?= $form->field($model, 'nguoi_tao') ?>

    <?= $form->field($model, 'ngay_tao') ?>

    <?php // echo $form->field($model, 'nguoi_sua') ?>

    <?php // echo $form->field($model, 'ngay_sua') ?>

    <?php // echo $form->field($model, 'trang_thai_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
