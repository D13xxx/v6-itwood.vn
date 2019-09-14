<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">Thêm ảnh cho banner</h4>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?php
            if($model->isNewRecord){
                echo $form->field($model, 'images[]')->widget(\kartik\file\FileInput::className(),[
                    'options'=>['accept'=>'image/*'],
                    'pluginOptions'=>[
                        'allowedFileExtensions'=>['jpg','jpeg','bmp','png','gif'],
                        'showPreview' => true,
                        'showRemove' => true,
                        'showUpload' => false,

                        'browseClass' => 'btn btn-success',
                        'uploadClass' => 'btn btn-info',
                        'removeClass' => 'btn btn-danger',
                        'browseLabel' => 'Chọn file ảnh',
                        'removeLabel' =>'Hủy bỏ'
                    ]
                ]);
            } else {

            }
            ?>

            <?= $form->field($model, 'status')->dropDownList([
                1=>'Hoạt động',
                0=>'Không hoạt động',
            ]) ?>

        </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('backend', 'Lưu thông tin'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
