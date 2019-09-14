<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\RegLoRung */

$this->title = Yii::t('frontend', 'Sửa thông tin lô rừng: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Danh sách lô rừng'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Chỉnh sửa');
?>
<div class="reg-lo-rung-update">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="panel-body">
            <?php
            $quyenSuDungDat = \common\models\RegQuyenSuDungDat::find()->where(['chu_the_id'=>$model->chu_the_id])->all();
            $listQSDD= \yii\helpers\ArrayHelper::map($quyenSuDungDat,'id',function ($data){
                return 'Mã :' .$data->ma.' - Số văn bản:'. $data->so_van_ban . ' - Ngày ban hành: '.$data->ngay_ban_hanh.' - Cơ quan ban hành: ' . $data->co_quan_ban_hanh;
            })
            ?>
            <div class="col-sm-12">
                <?= $form->field($model,'quyen_sdd_id')->widget(\kartik\select2\Select2::className(),[
                    'data'=>$listQSDD,
                    'pluginOptions'=>['allowClear'=>true],
                    'options'=>['prompt'=>Yii::t('frontend','Thuộc quyền sử dụng đất')]
                ])?>
            </div>
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
            <div class="col-sm-12">
                <?= $form->field($model,'khong_co_dinh_danh')->checkbox(['id'=>'khong_co_lo_rung'])?>
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

            <div class="col-sm-12">
                <?= $form->field($model, 'dia_chi')->textInput(['maxlength' => true]) ?>
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
    </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('backend', 'Lưu'), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>


</div>
<?php
$scripCheckbox = <<< JS
document.getElementById('khong_co_lo_rung').onchange = function() {
    document.getElementById('tieu_khu').disabled = this.checked;
    document.getElementById('khoanh').disabled = this.checked;
    document.getElementById('lo').disabled = this.checked;
};
JS;
$this->registerJs($scripCheckbox,\yii\web\View::POS_READY);
?>