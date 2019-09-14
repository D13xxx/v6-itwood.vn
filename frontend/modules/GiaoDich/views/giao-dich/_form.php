<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/28/2019
 * Time: 9:45 AM
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<?php $form = ActiveForm::begin(['id'=>'nhapLieu','options'=>['name'=>'nhapLieu','enctype'=>'multipart/form-data']]); ?>
<div class="panel panel-success">
    <div class="panel-heading">
        <h4 class="panel-title">Thông tin người mua</h4>
    </div>
    <div class="panel-body">
        <div class="col-sm-6">
            <?= Html::button(Yii::t('backend', 'Chọn người mua'), [
                'id' => 'modelButton',
                'value' => \yii\helpers\Url::to(['/giao-dich/giao-dich/chon-nguoi-mua', 'idLoaiChuThe' => $idLoaiChuThe]),
                'class' => 'btn btn-block btn-info'])?>
        </div>
        <div class="col-sm-6">
            <strong>Người mua không có trên hệ thống: <?= Html::checkbox('co_tren_he_thong',false,['id'=>'coTrenHeThong'])?></strong>
        </div>
        <hr>
        <div class="col-sm-12">
            <?= $form->field($model,'reg_chu_the_moi_id')->hiddenInput(['id'=>'reg_chu_the_moi_id'])->label(false)?>
            <?= $form->field($model,'ten_chu_the')->textInput(['readonly'=>true,'id'=>'ten_chu_the'])?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model,'so_cmtnd')->textInput(['readonly'=>true,'id'=>'so_cmtnd'])?>
            <?= $form->field($model,'ma_so_thue')->textInput(['readonly'=>true,'id'=>'ma_so_thue'])?>
            <?= $form->field($model,'so_hoa_don')->textInput()?>
            <?= $form->field($model,'ngay_hoa_don')->textInput()?>
        </div>

    </div>
    <div class="panel-footer">
        <?= \yii\helpers\Html::submitButton(Yii::t('frontend','Xác nhận bán'),['class'=>'btn btn-primary btn-block'])?>
    </div>
</div>
<?php ActiveForm::end();?>

<?php

\yii\bootstrap\Modal::begin([
    'header' => '<h4>Chọn người mua</h4>',
    'id'     => 'model',
    'size'   => 'model-lg',
]);

echo "<div id='modelContent'></div>";

\yii\bootstrap\Modal::end();

?>

<?php
$scriptNguoiMua = <<< JS
$('#modelButton').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });

$('#coTrenHeThong').change(function() {
    if(this.checked){
        // alert('Không có trên hệ thống');
        $('#ten_chu_the').attr('readOnly',false);
        $('#so_cmtnd').attr('readOnly',false);
        $('#ma_so_thue').attr('readOnly',false);
        $('#modelButton').attr('disabled',true);
    } else {
        // alert('Có trên hệ thống');  
        $('#ten_chu_the').attr('readOnly',true);
        $('#so_cmtnd').attr('readOnly',true);
        $('#ma_so_thue').attr('readOnly',true);
        $('#modelButton').attr('disabled',false);
    }
})
JS;

$this->registerJs($scriptNguoiMua);
?>