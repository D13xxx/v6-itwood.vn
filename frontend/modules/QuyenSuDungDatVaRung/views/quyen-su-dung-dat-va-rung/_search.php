<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\searchs\RegQuyenSuDungDatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-quyen-su-dung-dat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'quyen_su_dung_dat_id') ?>

    <?= $form->field($model, 'so_van_ban') ?>

    <?= $form->field($model, 'ngay_ban_hanh') ?>

    <?= $form->field($model, 'so_vao_so') ?>

    <?php // echo $form->field($model, 'co_quan_ban_hanh') ?>

    <?php // echo $form->field($model, 'trang_thai_id') ?>

    <?php // echo $form->field($model, 'chu_the_id') ?>

    <?php // echo $form->field($model, 'loai_chu_the_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('frontend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
