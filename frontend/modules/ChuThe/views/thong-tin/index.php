<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/12/2019
 * Time: 4:28 PM
 */
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

$this->title = Yii::t('frontend','Thông tin chủ thể');
?>

<div class="ho-so-chu-the">
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"><?= $this->title;?></h4>
        </div>
        <div class="panel-body">
            <?php
            if($modelUser->loai_chu_the_id==1){
                echo DetailView::widget([
                    'model'=>$model,
                    'attributes'=>[
                        'ma',
                        'ten_to_chuc',
                        'ten_thuong_mai',
                        'ten_tieng_nuoc_ngoai',
                        'giay_dang_ky_kd',
                        'ma_so_thue',
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
                        'dia_chi_tru_so',
                        'so_dien_thoai',
                        [
                            'attribute'=>'loai_hinh_hoat_dong_id',
                            'format'=>'html',
                            'value'=>function($data){
                                $tam=explode(';',$data->loai_hinh_hoat_dong_id);
                                $loaiHinhHoatDong=array();
                                foreach ($tam as $value){
                                    $loaiHinh=\common\models\SysLoaiHinhHoatDong::findOne($value);
                                    $loaiHinhHoatDong[]=$loaiHinh->ten;
                                }
                                return implode('<br>',$loaiHinhHoatDong);
                            }
                        ],
                        'nguoi_dai_dien',
                        'so_cmtnd',
                        [
                            'attribute'=>'ngay_cap',
                            'value'=>function($data)
                            {
                                return date("d/m/Y",strtotime($data->ngay_cap));
                            }
                        ],
                        'noi_cap',
                        'email',
                        'website',
                        [
                            'attribute'=>'file_dinh_kem',
                            'format'=>'html',
                            'value'=>function($data){
                                $tam = explode(';',$data->file_dinh_kem);
                                $anh=array();
                                foreach ($tam as $value){
                                    $pathName = Yii::getAlias('@linkImages').'/uploads/chu-the/to-chuc/';
                                    $anh[] = yii\helpers\Html::img($pathName.$value,['style'=>'width: 160px; height: 160px']);
                                }
                                return implode(' ',$anh);
                            }
                        ]
                    ]
                ]);
            } else {
                echo DetailView::widget([
                    'model'=>$model,
                    'attributes'=>[
                        'ma',
                        'ten',
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
                        'noi_thuong_tru',
                        'so_cmtnd',
                        [
                            'attribute'=>'ngay_cap',
                            'value'=>function($data)
                            {
                                return date("d/m/Y",strtotime($data->ngay_cap));
                            }
                        ],
                        'noi_cap',
//                        'ma_so_thue',
                        'so_dien_thoai',
                        'email',
                        [
                            'attribute'=>'loai_hinh_hoat_dong_id',
                            'format'=>'html',
                            'value'=>function($data){
                                $tam=explode(';',$data->loai_hinh_hoat_dong_id);
                                $loaiHinhHoatDong=array();
                                foreach ($tam as $value){
                                    $loaiHinh=\common\models\SysLoaiHinhHoatDong::findOne($value);
                                    $loaiHinhHoatDong[]=$loaiHinh->ten;
                                }
                                return implode('<br>',$loaiHinhHoatDong);
                            }
                        ],

                        [
                            'attribute'=>'file_dinh_kem',
                            'format'=>'html',
                            'value'=>function($data){
                                $tam = explode(';',$data->file_dinh_kem);
                                $anh=array();
                                foreach ($tam as $value){
                                    $pathName = Yii::getAlias('@linkImages').'/uploads/chu-the/ho-gia-dinh/';
                                    $anh[] = yii\helpers\Html::img($pathName.$value,['style'=>'width: 160px; height: 160px']);
                                }
                                return implode(' ',$anh);
                            }
                        ]
                    ]
                ]);
            }
            ?>

        </div>
        <div class="panel-footer">
            <?= \yii\helpers\Html::a(Yii::t('frontenr','Đổi mật khẩu'),['/chu-the/thong-tin/doi-mat-khau','id'=>$modelUser->id],['class'=>'btn btn-danger'])?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
