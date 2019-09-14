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

$this->title = Yii::t('backend','Thông tin lô rừng: ').$model->ma;

?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title"> <?= Html::encode($this->title) ?> </h4>
    </div>
    <div class="panel-body">
        <div class="col-sm-6">
            <h4 class="panel-title"><?= Yii::t('backend','Thông tin Chủ sở hữu')?></h4>
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
            <h4 class="panel-title"><?= Yii::t('backend','Thông tin quyền sử dụng đất')?></h4>
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
            <h4 class="panel-title"><?= Yii::t('backend','Thông tin lô rừng')?></h4>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute'=>'loai_rung_id',
                        'value'=>function($data){
                            return $data->loaiRung ? $data->loaiRung->ten : null;
                        }
                    ],
                    'ma',
                    'tieu_khu',
                    'khoanh',
                    'lo',
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
                        'format'=>'html',
                        'value'=>function($data){
                            if($data->khong_co_dinh_danh==1){
                                return '<span class="label label-warning" style="font-size: 15px; font-weight: bolder">Rừng chưa có định danh</span>';
                            } else {
                                return '';
                            }
                        }
                    ],
                ],
            ])?>

        </div>
        <div class="col-sm-12">
            <h4 class="panel-title"><?= Yii::t('backend','Lý do không duyệt lô Rừng')?></h4>
            <hr>
            <?= GridView::widget([
                'summary'=>'',
                'dataProvider'=>$dataProvider,
                'filterModel'=>$searchModel,
                'columns'=>[
                    [
                        'class'=>'yii\grid\SerialColumn',
                        'contentOptions'=>['style'=>'vertical-align: middle']
                    ],
                    'ly_do:html',
                    [
                        'attribute'=>'nguoi_lap',
                        'value'=>function($data){
                            return $data->nguoiLap ? $data->nguoiLap->fullname : null;
                        },
                        'contentOptions'=>['style'=>'vertical-align: middle']
                    ],
                    [
                        'attribute'=>'ngay_lap',
                        'value'=>function($data){
                            return ($data->ngay_lap != ''||$data->ngay_lap!=null) ? date("d/m/Y H:i:s",strtotime($data->ngay_lap)) : '';
                        },
                        'contentOptions'=>['style'=>'vertical-align: middle']
                    ],
                ]
            ]);?>
        </div>
    </div>
    <div class="panel-footer">
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

$scriptModal = <<< JS
    $(function(){
        $('#modalButton').click(function(){
        $('#userModal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
        });
    });
JS;
$this->registerJS($scriptModal,\yii\web\View::POS_READY);
?>
<div class="clearfix"></div>