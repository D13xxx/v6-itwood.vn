<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\searchs\RegSystemFormisSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="reg-system-formis-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'url') ?>

    <?php echo $form->field($model, 'bang_du_lieu') ?>

    <?php echo $form->field($model, 'trang_thai_id') ?>

    <?php echo $form->field($model, 'ngay_khoi_tao') ?>

    <?php // echo $form->field($model, 'nguoi_khoi_tao') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
