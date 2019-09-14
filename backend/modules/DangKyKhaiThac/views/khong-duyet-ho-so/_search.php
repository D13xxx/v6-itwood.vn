<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\searchs\RegHoSoXnKhaiThacKhongDuyetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-ho-so-xn-khai-thac-khong-duyet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'reg_ho_so_xin_khai_thac_id') ?>

    <?= $form->field($model, 'ly_do') ?>

    <?= $form->field($model, 'nguoi_lap') ?>

    <?= $form->field($model, 'ngay_lap') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
