<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\RegChuTheToChucSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
if(Yii::$app->controller->action->id=='de-nghi-duyet'){
    $this->title = Yii::t('backend', 'Đề nghị duyệt');
    $maMau = 'primary';
}
if(Yii::$app->controller->action->id=='da-duoc-duyet'){
    $this->title = Yii::t('backend', 'Đã được duyệt');
    $maMau='success';
}
if(Yii::$app->controller->action->id=='khong-duoc-duyet'){
    $this->title = Yii::t('backend', 'Không được duyệt');
    $maMau='warning';
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-chu-the-to-chuc-index">

    <div class="panel panel-<?=$maMau?>">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?= Html::encode($this->title) ?>
            </h4>
        </div>
        <div class="panel-body">
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'ma',
                    'ten_to_chuc',
//                    'ten_thuong_mai',
//                    'ten_tieng_nuoc_ngoai',
                    'giay_dang_ky_kd',
                    'ma_so_thue',
                    [
                        'attribute'=>'loai_hinh_hoat_dong_id',
                        'format'=>'html',
                        'value'=>function($data){
                            if(strlen($data->loai_hinh_hoat_dong_id)>=1){
                                $arrayItems = explode(';',$data->loai_hinh_hoat_dong_id);
                                $loaiHinhHoatDong='';
                                foreach ($arrayItems as $item){
                                    $loaiHinhHoatDong .= '- '.\common\models\RegChuTheToChuc::LOAI_HINH_HOAT_DONG_ARRAY[$item].'<br>';
                                }

                                return $loaiHinhHoatDong;
                            }
                        }
                    ],
                    'nguoi_dai_dien',
                    //'so_cmtnd',
                    //'ngay_cap',
                    //'noi_cap',
                    //'dia_chi_tru_so',
                    //'website',
                    //'email:email',
                    //'so_dien_thoai',
                    //'ngay_tao',
                    //'nguoi_duyet',
                    //'ngay_duyet',
                    //'trang_thai_id',
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
                    //'file_dinh_kem:ntext',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{view}'
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
<div class="clearfix"></div>