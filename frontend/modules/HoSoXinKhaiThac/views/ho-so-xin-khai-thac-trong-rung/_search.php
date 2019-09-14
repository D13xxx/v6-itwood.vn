<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\searchs\RegHoSoXinKhaiThacTrongRungSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-ho-so-xin-khai-thac-trong-rung-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'reg_lo_rung_id') ?>

    <?= $form->field($model, 'loai_cay_trong_id') ?>

    <?= $form->field($model, 'phuong_thuc_trong_id') ?>

    <?= $form->field($model, 'nam_trong') ?>

    <?php // echo $form->field($model, 'loai_von_dau_tu_id') ?>

    <?php // echo $form->field($model, 'chu_so_huu') ?>

    <?php // echo $form->field($model, 'reg_ho_so_xin_khai_thac_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('frontend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
