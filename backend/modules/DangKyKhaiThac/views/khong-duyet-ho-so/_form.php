<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoXnKhaiThacKhongDuyet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-ho-so-xn-khai-thac-khong-duyet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reg_ho_so_xin_khai_thac_id')->textInput() ?>

    <?= $form->field($model, 'ly_do')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nguoi_lap')->textInput() ?>

    <?= $form->field($model, 'ngay_lap')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
