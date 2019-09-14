<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TinTuc */
/* @var $form yii\widgets\ActiveForm */

$plugin=[
    "advlist autolink lists link charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table contextmenu paste image"
];
$toolbar="undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image";
?>

<div class="tin-tuc-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data'],
    ]); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">Thêm tin tức mới</h4>
        </div>
        <div class="panel-body">
            <?php
            if($model->isNewRecord){
                $pluginOptions = [
                    'allowedFileExtensions'=>['jpg','jpeg','bmp','png','gif'],
                    'showPreview' => true,
                    'showRemove' => true,
                    'showUpload' => false,

                    'browseClass' => 'btn btn-success',
                    'uploadClass' => 'btn btn-info',
                    'removeClass' => 'btn btn-danger',
                    'browseLabel' => 'Chọn file ảnh',
                    'removeLabel' =>'Hủy bỏ'
                ];
            } else {
                $pluginOptions = [
                    'initialPreview'=>[
                        '../uploads/website/tin-tuc/'.$model->anh_dai_dien
                    ],
                    'initialPreviewAsData'=>true,
                    'allowedFileExtensions'=>['jpg','jpeg','bmp','png','gif'],
                    'showPreview' => true,
                    'showRemove' => true,
                    'showUpload' => false,

                    'browseClass' => 'btn btn-success',
                    'uploadClass' => 'btn btn-info',
                    'removeClass' => 'btn btn-danger',
                    'browseLabel' => 'Chọn file ảnh',
                    'removeLabel' =>'Hủy bỏ'
                ];
            }
            ?>
            <?= $form->field($model, 'tieu_de')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'tom_tat')->textarea(['rows' => 3]) ?>

            <?= $form->field($model, 'chi_tiet')->widget(\dosamigos\tinymce\TinyMce::className(),[
                'options' => ['rows' => 18],
                'language' => 'vi',
                'clientOptions' => [
                    //'width'=>'82.90598290598291%',
                    'branding'=> false,
                    'plugins' => $plugin,
                    'toolbar' => $toolbar,
                    'file_picker_callback' => \alexantr\elfinder\TinyMCE::getFilePickerCallback(['/elfinder/tinymce']),
                ],
//                'fileManager' => [
//                    'class' => \dominus77\tinymce\components\MihaildevElFinder::className(),
//                ],
            ]) ?>

            <?= $form->field($model, 'anh_dai_dien')->widget(\kartik\file\FileInput::className(),[
                'options'=>['accept'=>['*']],
                'pluginOptions'=> $pluginOptions
            ]) ?>

            <?= $form->field($model,'tin_noi_bat')->checkbox()?>
            <?= $form->field($model, 'status')->dropDownList([
                1=>'Hoạt động',
                0 =>'Không hoạt động'
            ]) ?>

        </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
