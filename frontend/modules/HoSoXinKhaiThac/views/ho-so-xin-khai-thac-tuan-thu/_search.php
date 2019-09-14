<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\searchs\RegHoSoXinKhaiThacTuanThuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-ho-so-xin-khai-thac-tuan-thu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'reg_ho_so_xin_khai_thac_id') ?>

    <?= $form->field($model, 'reg_trach_nhiem_tuan_thu_id') ?>

    <?= $form->field($model, 'gia_tri') ?>

    <?= $form->field($model, 'file_dinh_kem') ?>

    <?php // echo $form->field($model, 'reg_lo_rung_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('frontend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
