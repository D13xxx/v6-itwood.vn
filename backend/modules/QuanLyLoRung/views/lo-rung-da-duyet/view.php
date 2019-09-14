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

$this->title = Yii::t('backend','Thông tin lô rừng').$model->ma;

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
        <div class="col-sm-12"; >
            <h4 class="panel-title"><?php
                if((int)\common\models\RegLoRung::CountLoRungPhucTra($model->id) > 0){
                    echo '<span style="background-color:#8bd83b; color: white">'.Yii::t('backend','Thông tin lô rừng').'</span>';
                } else {
                    echo Yii::t('backend','Thông tin lô rừng');
                }
            ?></h4>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute'=>'loai_rung_id',
                        'format'=>'raw',
                        'value'=>function($data){
                            return $data->loaiRung ? $data->loaiRung->ten : null;
                        },

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
                        'format'=>'html',
                        'value'=>function($data){
                            if($data->khong_co_dinh_danh==1){
                                return '<span class="label label-warning" style="font-size: 15px; font-weight: bolder">Rừng chưa có định danh</span>';
                            } else { return ''; }
                        }
                    ],
                ],
            ])?>

        </div>
        <?php
        if((int)\common\models\RegLoRung::CountLoRungPhucTra($model->id)>0){
            echo '<h4 class="panel-title">' .Yii::t('backend','Thông tin phúc tra'). '</h4>';
            echo GridView::widget([
                'dataProvider'=>$dataPhucTra,
                'summary'=>'',
                'columns'=>[
                    ['class'=>'yii\grid\SerialColumn'],
                    'reg_lo_rung_ma_cu',
                    'reg_lo_rung_ma_moi',
                    [
                        'attribute'=>'nguoi_tao',
                        'value'=>function($data){
                            return $data->nguoiTao ? $data->nguoiTao->fullname : '';
                        }
                    ],
                    [
                        'attribute'=>'ngay_tao',
                        'value'=>function($data){
                            return date("d/m/Y H:i:s",strtotime($data->ngay_tao));
                        }
                    ]
                ]
            ]);
        }
        ?>
    </div>
    <div class="panel-footer">
        <?= Html::a(Yii::t('backend', 'In hồ sơ Rừng'), ['/quan-ly-lo-rung/in-ho-so/index','id'=>$model->id], ['class' => 'btn btn-success']) ?>

        <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
    </div>
</div>

<div class="clearfix"></div>