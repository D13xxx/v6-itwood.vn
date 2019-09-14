<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use demogorgorn\ajax\AjaxSubmitButton;
/* @var $this yii\web\View */
/* @var $model common\models\RegLoRung */
/* @var $form yii\widgets\ActiveForm */
$quyenSuDungDat= Yii::$app->getRequest()->getQueryParam('soDoID');
if($model->isNewRecord){
    $upUrl= \yii\helpers\Url::to(['/quyen-su-dung-dat-va-rung/lo-rung/create','soDoID'=>$quyenSuDungDat]);
} else {
    $upUrl= \yii\helpers\Url::to(['/quyen-su-dung-dat-va-rung/lo-rung/create','soDoID'=>$quyenSuDungDat]);
}
$scriptWindow = <<< JS
$( "#btnCancel" ).click(function() {
    window.opener.gridLoRungReload();
    window.close();
});

JS;

$this->registerJs($scriptWindow,\yii\web\View::POS_READY);
?>
<div class="reg-lo-rung-form">

    <?php $form = ActiveForm::begin([
        'id' => "them-lo-rung",
        'action' => 'javascript:void(0)',
        'options' => ['class' => 'edit_form'],
//        'enableClientValidation' => true
    ]); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"><?= Html::encode($this->title)?></h4>
        </div>
        <div class="panel-body">
            <?php
            $loaiRung = \common\models\SysLoaiRung::find()->active()->all();
            $listLoaiRung = \yii\helpers\ArrayHelper::map($loaiRung,'id','ten');
            ?>
            <div class="col-sm-12">
                <?= $form->field($model,'loai_rung_id')->widget(\kartik\select2\Select2::className(),[
                        'data'=>$listLoaiRung,
                    'options'=>['id'=>'loaiRungID']
                ]); ?>
            </div>

            <div class="col-sm-4">
                <?= $form->field($model, 'tieu_khu')->textInput(['maxlength' => true,'id'=>'tieu_khu']) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'khoanh')->textInput(['maxlength' => true,'id'=>'khoanh']) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'lo')->textInput(['maxlength' => true,'id'=>'lo']) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'dien_tich')->textInput(['maxlength' => true,'id'=>'dien_tich']) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'so_thua_dat')->textInput(['maxlength' => true,'id'=>'so_thua_dat']) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'to_ban_do_so')->textInput(['maxlength' => true,'id'=>'to_ban_do_so']) ?>
            </div>

            <?php
            $tinhThanh = \common\models\TinhThanh::find()->active()->all();
            $listTinhThanh = \yii\helpers\ArrayHelper::map($tinhThanh,'id','ten');
            ?>
            <div class="col-sm-4">
                <?= $form->field($model, 'tinh_thanh_id')->widget(\kartik\select2\Select2::className(),[
                    'data'=>$listTinhThanh,
                    'options'=>[
                        'prompt'=>Yii::t('frontend','Lựa chọn tỉnh thành'),
                        'onchange'=>'
                        $.get( "'.\yii\helpers\Url::toRoute('/site/danh-sach-quan-huyen').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'quan_huyen_id').'" ).html( data );
                            }
                        );
                    '
                    ],
                    'pluginOptions'=>['allowClear'=>true]
                ]) ?>
            </div>
            <div class="col-sm-4">
                <?php
                if(is_null($model->tinh_thanh_id))
                {
                    $listQuanHuyen=array();
                }else {
                    $quanHuyen=\common\models\QuanHuyen::find()->where(['tinh_thanh_id'=>$model->tinh_thanh_id])->all();
                    $listQuanHuyen=\yii\helpers\ArrayHelper::map($quanHuyen,'id','ten');
                }
                ?>
                <?= $form->field($model, 'quan_huyen_id')->widget(\kartik\select2\Select2::className(),[
                    'data'=>$listQuanHuyen,
                    'options'=>[
                        'prompt'=>Yii::t('frontend','Lựa chọn Quận huyện'),
                        'onchange'=>'
                        $.get( "'.\yii\helpers\Url::toRoute('/site/danh-sach-xa-phuong').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'xa_phuong_id').'" ).html( data );
                            }
                        );
                    '
                    ],
                    'pluginOptions'=>['allowClear'=>true]
                ]) ?>
            </div>
            <div class="col-sm-4">
                <?php
                if(is_null($model->quan_huyen_id))
                {
                    $listXaPhuong=array();
                }else {
                    $phuongXa = \common\models\XaPhuong::find()->where(['quan_huyen_id'=>$model->quan_huyen_id])->all();
                    $listXaPhuong = \yii\helpers\ArrayHelper::map($phuongXa, 'id', 'ten');
                }
                ?>
                <?= $form->field($model, 'xa_phuong_id')->widget(\kartik\select2\Select2::className(),[
                    'data'=>$listXaPhuong,
                    'options'=>['prompt'=>Yii::t('frontend','Lựa chọn Xã phường')],
                    'pluginOptions'=>['allowClear'=>true],
                ]) ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($model, 'dia_chi')->textInput(['maxlength' => true])->label('Địa chỉ lô rừng (Thôn/Xóm)') ?>
            </div>

        </div>
        <div class="panel-footer">
<!--            --><?//= Html::submitButton()?>
            <div class="col-sm-6">

                <?php AjaxSubmitButton::begin([
                    'label' => Yii::t('frontend','Lưu thông tin'),
                    'id' => 'some_form',
                    'useWithActiveForm' =>'them-lo-rung',
                    'ajaxOptions'=> [
                        'type' => 'POST',
                        'url' => $upUrl,
                        'success' => new \yii\web\JsExpression(
                            'function(data){
                                if(data=="success"){
                                    window.opener.gridLoRungReload();
                                    window.close();
                                }
                            }'
                        ),
                    ],
                    'options'=>['class'=>'btn btn-success btn-block','type'=>'submit']
                ]);
                AjaxSubmitButton::end();
                ?>
            </div>
            <div class="col-sm-6">
                <?= Html::a('Hủy bỏ', false, ['class'=>'btn btn-default btn-block','id'=>'btnCancel']) ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<?php
//$scripCheckbox = <<< JS
//document.getElementById('khong_co_lo_rung').onchange = function() {
//    document.getElementById('tieu_khu').disabled = this.checked;
//    document.getElementById('khoanh').disabled = this.checked;
//    document.getElementById('lo').disabled = this.checked;
//};
//JS;
//$this->registerJs($scripCheckbox,\yii\web\View::POS_READY);
?>