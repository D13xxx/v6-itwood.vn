<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/12/2019
 * Time: 9:47 AM
 */
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('backend','Xét duyệt lô rừng').$model->ma;

?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title"> <?= Html::encode($this->title) ?> </h4>
    </div>
    <div class="panel-body">
        <div class="col-sm-6">
            <h4 class="panel-title" style="font-weight: bolder"><?= Yii::t('backend','Thông tin Chủ sở hữu')?></h4><br>
            <?= DetailView::widget([
                'model' => $modelChuThe,
                'attributes' => [
                    'ma',
                    [
                        'label'=>Yii::t('backend','Tên'),
                        'value'=>function($data){
                            return isset($data->ten) ? $data->ten : $data->ten_to_chuc;
                        }
                    ],
                    [
                        'label'=>Yii::t('backend','Số đăng ký kinh doanh'),
                        'value'=>function($data){
                            return isset($data->giay_dang_ky_kd)? $data->giay_dang_ky_kd : null;
                        },
                        'visible'=>(isset($modelChuThe->giay_dang_ky_kd)? true : false)
                    ],
                    [
                        'label'=>Yii::t('backend','Mã số thuế'),
                        'value'=>function($data){
                            return isset($data->ma_so_thue)? $data->ma_so_thue : null;
                        },
                        'visible'=>(isset($modelChuThe->ma_so_thue)? true : false)
                    ],
                    [
                        'label'=>Yii::t('backend','Người đại diện'),
                        'value'=>function($data){
                            return isset($data->nguoi_dai_dien) ? $data->nguoi_dai_dien : null;
                        },
                        'visible'=>(isset($modelChuThe->nguoi_dai_dien) ? true : false)
                    ],
                    'so_cmtnd',
                    [
                        'label'=>Yii::t('backend','Địa chỉ'),
                        'value'=>function($data){
                            return isset($data->noi_thuong_tru) ? $data->noi_thuong_tru : $data->dia_chi_tru_so;
                        }
                    ],
                    [
                        'label' => Yii::t('backend','Email liên hệ'),
                        'value'=>function($data){
                            return $data->email;
                        }
                    ],
                    [
                        'label'=>Yii::t('backend','Số điện thoại'),
                        'value'=>function($data){
                            return $data->so_dien_thoai;
                        }
                    ],
                    [
                        'attribute'=>'trang_thai_id',
                        'value'=>function($data) use ($modelQSD) {
                            if($modelQSD->loai_chu_the_id==1){
                                return \common\models\RegChuTheToChuc::TRANG_THAI_ARRAY[$data->trang_thai_id];
                            } else {
                                return \common\models\RegChuTheHoGiaDinh::TRANG_THAI_ARRAY[$data->trang_thai_id];
                            }
                        }
                    ],
                ],
            ])?>
        </div>
        <div class="col-sm-6">
            <h4 class="panel-title" style="font-weight: bolder"><?= Yii::t('backend','Thông tin quyền sử dụng đất')?></h4><br>
            <?= DetailView::widget([
                'model' => $modelQSD,
                'attributes' => [
                    'ma',
                    'so_van_ban',
                    [
                        'attribute'=>'ngay_ban_hanh',
                        'value'=>function($data){
                            return ($data->ngay_ban_hanh!='') ? date('d/m/Y',strtotime($data->ngay_ban_hanh)) : '';
                        }
                    ],
                    'so_vao_so',
                    'co_quan_ban_hanh',
                    [
                        'attribute'=>'file_dinh_kem',
                        'format'=>'html',
                        'value'=>function($data){
                            if($data->file_dinh_kem != '' || $data->file_dinh_kem !=null){
                                $fileAnhs = explode(';',$data->file_dinh_kem);
                                foreach ($fileAnhs as $fileAnh){
                                    return Html::a(Html::img('/uploads/quyen-su-dung-dat/'.$fileAnh,['class'=>'img-thumbnail', 'style'=>'width:120px; height:100px']),
                                        ['view-file','id'=>$data->id,'fileName'=>$fileAnh],[
                                            'class'=>'windowPopUp'
                                        ]);
                                }
                            }
                            return '';
                        }
                    ],
                ],
            ])?>
        </div>
        <div class="col-sm-12">
            <h4 class="panel-title" style="font-weight: bolder">
                <?= Yii::t('backend','Thông tin lô rừng')?>
            </h4>
            <br>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute'=>'loai_rung_id',
                        'value'=>function($data){
                            return $data->loaiRung ? $data->loaiRung->ten : null;
                        }
                    ],
                    [
                        'attribute'=>'ma',
                        'value'=>function($data){
                            if($data->khong_co_dinh_danh==1){
                                return '';
                            } else {
                                return $data->ma;
                            }
                        }
                    ],
                    [
                        'attribute'=>'tieu_khu',
                        'value'=>function($data){
                            return $data->khong_co_dinh_danh==1 ? '' : $data->tieu_khu;
                        }
                    ],
                    [
                        'attribute'=>'khoanh',
                        'value'=>function($data){
                            return $data->khong_co_dinh_danh==1 ? '' : $data->khoanh;
                        }
                    ],
                    [
                        'attribute'=>'lo',
                        'value'=>function($data){
                            return $data->khong_co_dinh_danh==1 ? '' : $data->lo;
                        }
                    ],
                    'dien_tich',
                    'so_thua_dat',
                    'dia_chi',
                    [
                        'attribute'=>'tinh_thanh_id',
                        'value'=>function($data){
                            return $data->tinhThanh ? $data->tinhThanh->ten : null;
                        }
                    ],
                    [
                        'attribute'=>'quan_huyen_id',
                        'value'=>function($data){
                            return $data->quanHuyen ? $data->quanHuyen->ten : null;
                        }
                    ],
                    [
                        'attribute'=>'xa_phuong_id',
                        'value'=>function($data){
                            return $data->xaPhuong ? $data->xaPhuong->ten : null;
                        }
                    ],
                    [
                        'label'=>Yii::t('backend','Kiểm tra lô rừng'),
                        'format'=>'raw',
                        'value'=>function($data){
                            if($data->khong_co_dinh_danh==1){
                                return '<span class="label label-warning" style="font-size: 15px; font-weight: bolder">Rừng chưa có định danh</span>';
                            } else {
                                $kiemtraFormis= Html::button(Yii::t('backend','Kiểm tra trên FORMIS'),
                                    [
                                        'id'=>'modalFomis',
                                        'value'=>\yii\helpers\Url::to(['/quan-ly-lo-rung/de-nghi-duyet/kiem-tra-formis','id'=>$data->id]),
                                        'class'=>'btn btn-primary',
                                    ]);
                                $kiemTraInno = Html::button(Yii::t('backend','Kiểm tra trên hệ thống'),
                                    [
                                        'id'=>'modalHT',
                                        'value'=>\yii\helpers\Url::to(['/quan-ly-lo-rung/de-nghi-duyet/kiem-tra-lo-rung','id'=>$data->id]),
                                        'class'=>'btn btn-success',
                                    ]);
                                return $kiemtraFormis . ' '.$kiemTraInno;

                            }
                        }
                    ],
                ],
            ])?>

        </div>
    </div>
    <div class="panel-footer">
        <?php
        if($model->khong_co_dinh_danh != 1){ ?>
            <?= Html::a(Yii::t('backend', 'Duyệt lô rừng'), ['duyet','id'=>$model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::button(Yii::t('backend', 'Không duyệt lô rừng'),
                [
                    'value'=>\yii\helpers\Url::to(['/quan-ly-lo-rung/khong-duyet-lo-rung/khong-duyet','id'=>$model->id]),
                    'id'=> 'modalButton',
                    'class' => 'btn btn-warning',
                ]
            );?>
        <?php }
        ?>
        <?= Html::a(Yii::t('backend', 'Chuyển phúc tra'), ['chuyen-phuc-tra', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
    </div>
</div>

<?php
\yii\bootstrap\Modal::begin([
    'id' => 'userModal',
    'header' => '<h4 style="text-align: center">'.Yii::t('backend','Không duyệt lô rừng').'</h4>',
    'size'=>'modal-lg',
]);
echo '<div id="modalContent"></div>';
\yii\bootstrap\Modal::end();

\yii\bootstrap\Modal::begin([
    'id'=>'formisModal',
    'header' => '<h4 style="text-align: center">'.Yii::t('backend','Thông tin lô rừng trên FORMIS').'</h4>',
    'size'=>'modal-lg',
]);
echo '<div id="formisContent"></div>';
\yii\bootstrap\Modal::end();

\yii\bootstrap\Modal::begin([
    'id'=>'kiemTraLoRungModal',
    'header' => '<h4 style="text-align: center">'.Yii::t('backend','Thông tin lô rừng trên FORMIS').'</h4>',
    'size'=>'modal-lg',
]);
echo '<div id="kiemTraLoRungContent"></div>';
\yii\bootstrap\Modal::end();

$scriptModal = <<< JS
    $(function(){
        $('#modalButton').click(function(){
        $('#userModal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
        });
    });
$(function() {
    $('#modalFomis').click(function() {
        $('#formisModal').modal('show').find('#formisContent').load($(this).attr('value'));
    });
});
$(function() {
    $('#modalHT').click(function() {
        $('#kiemTraLoRungModal').modal('show').find('#kiemTraLoRungContent').load($(this).attr('value'));
    });
});
JS;
$this->registerJS($scriptModal,\yii\web\View::POS_READY);
?>
<div class="clearfix"></div>