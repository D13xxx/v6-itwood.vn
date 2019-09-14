<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\RegQuyenSuDungDat */
/* @var $form yii\widgets\ActiveForm */
$scriptLoadGrid = <<< JS
window.gridLoRungReload = function() {
  $.pjax.reload({container:'#danhSachLoRung'})
}
JS;
$this->registerJs($scriptLoadGrid,\yii\web\View::POS_READY)
?>

<div class="reg-quyen-su-dung-dat-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="panel-body">
            <div class="col-sm-4">
                <?= $form->field($model,'ma')->textInput(['readonly'=>true,'value'=>uniqid()])?>
            </div>
            <div class="col-sm-8">
                <?php
                $quyenSudungdat = \common\models\SysQuyenSuDungDat::find()->active()->all();
                $listQuyenSuDungDat = \yii\helpers\ArrayHelper::map($quyenSudungdat,'id','ten');
                ?>
                <?= $form->field($model,'quyen_su_dung_dat_id')->widget(\kartik\select2\Select2::className(),[
                    'data'=>$listQuyenSuDungDat,
                    'disabled'=>true
                ])?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'so_van_ban')->textInput(['maxlength' => true,'readonly'=>true]) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'ngay_ban_hanh')->widget(\kartik\date\DatePicker::className(),[
                    'value'=>function($data){
                        return date("d/m/Y",strtotime($data->ngay_ban_hanh));
                    },
                    'options' => [
                        'autoclose' => true,
                        'format' => 'dd/M/yyyy'
                    ],'disabled'=>true
                ]); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'so_vao_so')->textInput(['maxlength' => true,'readonly'=>true]) ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($model, 'co_quan_ban_hanh')->textInput(['maxlength' => true,'readonly'=>true]) ?>
                <?php
                $fileTams = explode(';',$model->file_dinh_kem);
                $filePreview = [];
                foreach ($fileTams as $fileTam)
                {
                    $filePreview[]= Html::img(Yii::getAlias('@linkImages').'/uploads/quyen-su-dung-dat/'.$fileTam,['class'=>'file-preview-image']);
                }
                ?>
                <?= $form->field($model, 'file_dinh_kem[]')->widget(\kartik\file\FileInput::className(),[
                    'options' => [
                        'multiple' => true,
                    ],
                    'pluginOptions'=> [
                        'initialPreview'=>$filePreview,
                        'initialPreviewAsData'=>true,
                        'overwriteInitial'=>false,
                        'allowedFileExtensions'=>['jpg','jpeg','bmp','png','gif'],
                        'showPreview' => true,
                        'showRemove' => true,
                        'showUpload' => false,

                        'browseClass' => 'btn btn-success',
                        'uploadClass' => 'btn btn-info',
                        'removeClass' => 'btn btn-danger',
                        'browseLabel' => 'Chọn file ảnh',
                        'removeLabel' =>'Hủy bỏ'
                    ],'disabled'=>true
                ]);?>
            </div>
            <div class="clearfix"></div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Danh sách lô rừng

                    </h4>
                </div>
                <div class="panel-body">

                    <?= GridView::widget([
                        'summary'=>'',
                        'dataProvider'=>$dataLoRung,
                        'pjax'=>true,
                        'pjaxSettings'=>[
                            'neverTimeout'=>true,
                            'options'=>[
                                'id'=>'danhSachLoRung',
                            ],
                        ],
//                        'filterModel'=>$searchLoRung,
                        'tableOptions' =>['class' => 'table table-striped table-bordered','id'=>'BangDuLieu'],
                        'columns'=>[
                            ['class'=>'yii\grid\SerialColumn'],
                            [
                                'attribute'=>'ma',
                            ],
                            [
                                'attribute'=>'tieu_khu',
                            ],
                            [
                                'attribute'=>'khoanh',
                            ],
                            [
                                'attribute'=>'lo',
                            ],
                            [
                                'attribute'=>'dia_chi',

                            ],
                            'dien_tich',
                            'so_thua_dat',
                            [
                                'attribute'=>'tinh_thanh_id',
                                'value'=>function($data){
                                    return $data->tinhThanh ? $data->tinhThanh->ten : '';
                                }
                            ],
                            [
                                'attribute'=>'quan_huyen_id',
                                'value'=>function($data){
                                    return $data->quanHuyen ? $data->quanHuyen->ten : '';
                                }
                            ],
                            [
                                'attribute'=>'xa_phuong_id',
                                'value'=>function($data){
                                    return $data->xaPhuong ? $data->xaPhuong->ten : '';
                                }
                            ],
                            [
                                'attribute'=>'trang_thai_id',
                                'format'=>'html',
                                'value'=>function($data){
                                    return \common\models\RegLoRung::TT_ARRAY()[$data->trang_thai_id];
                                }
                            ]
                        ]
                    ])?>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <?= Html::a(Yii::t('frontend','Thêm lô rừng'),
                ['/quyen-su-dung-dat-va-rung/lo-rung/create','soDoID'=>$model->id],
                ['class'=>'btn btn-primary wndPopup']
            )?>
            <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<?php
$script= <<< JS
    
    $(document).ready(function() {
    $('#BangDuLieu').DataTable( {
        // "paging":   false,
        "ordering": false,
        "info":     false,
        "language": {
            "search": 'Lọc thông tin:',
            "lengthMenu": "Hiển thị _MENU_ số bảng ghi trên trang",
            "zeroRecords": "Không tìm thấy dữ liệu",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "paginate": {
                "next": ">>",
                "previous": "<<"
            }
        },
        
    } );
} );
JS;

$this->registerJs($script,\yii\web\View::POS_READY);
?>