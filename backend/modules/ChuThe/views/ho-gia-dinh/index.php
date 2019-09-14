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
                    'ten',
                    'so_cmtnd',
                    [
                        'attribute'=>'ngay_cap',
                        'value'=>function($data){
                            if($data->ngay_cap != ''|| $data->ngay_cap!=null){
                                return date("d/m/Y",strtotime($data->ngay_cap));
                            } else {
                                return '';
                            }
                        }
                    ],
                    'noi_cap',
                    [
                        'attribute'=>'loai_hinh_hoat_dong_id',
                        'format'=>'html',
                        'value'=>function($data){
                            if(strlen($data->loai_hinh_hoat_dong_id)>=1){
                                $arrayItems = explode(';',$data->loai_hinh_hoat_dong_id);
                                $loaiHinhHoatDong='';
                                foreach ($arrayItems as $item){
                                    $loaiHinhHoatDong .= '- '.\common\models\RegChuTheHoGiaDinh::LOAI_HINH_HOAT_DONG_ARRAY[$item].'<br>';
                                }

                                return $loaiHinhHoatDong;
                            }
                        }
                    ],
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