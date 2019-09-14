<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/4/2019
 * Time: 10:24 AM
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="duyet-lo-rung-phuc-tra">
    <? \yii\widgets\Pjax::begin() ?>
    <?php $form = ActiveForm::begin([
//        'enableAjaxValidation' => true,
//        'options' => ['data-pjax' => 1],
//        'id'=>'duyt-lo-rung-sau-phuc-tra'
    ]); ?>
    <div class="panel panel-primary">
        <div class="panel-body">
            <?= $form->errorSummary($model) ?>
            <?= $form->field($model,'tieu_khu')->textInput()?>
            <?= $form->field($model,'khoanh')->textInput()?>
            <?= $form->field($model,'lo')->textInput()?>
            <?= $form->field($model,'dia_chi')->textInput()?>
            <?= $form->field($model,'ngoai_ba_loai_rung')->checkbox()?>
            <?= $form->field($model,'so_thua_dat')->textInput()?>
            <?= $form->field($model,'to_ban_do_so')->textInput()?>

        </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('backend', 'Lưu thông tin'), ['class' => 'btn btn-primary','name'=>'luuThongTin','value' => 'create_update']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <? \yii\widgets\Pjax::end() ?>
</div>
