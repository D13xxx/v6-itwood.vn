<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoGo */

$this->title = $model->ma;
if($model->trang_thai_id==\common\models\RegHoSoGo::TT_HSG_DUOCDUYET){
    $this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Danh sách hồ sơ gỗ đã duyệt'), 'url' => ['ho-so-da-duyet']];
} else {
    $this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Danh sách hồ sơ gỗ mới'), 'url' => ['ho-so-moi']];
}
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reg-ho-so-go-view">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"> Xem chi tiết: <?= Html::encode($this->title) ?> </h4>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model'=>$model,
                'attributes'=>[
                    'ma',
                    [
                        'attribute'=>'ngay_lap',
                        'value'=>function($data){
                            return date("d/m/Y", strtotime($data->ngay_lap));
                        }
                    ],
                    [
                        'label'=>Yii::t('backend','Khối lượng lô gỗ'),
                        'value'=>function($data)
                        {
                            return \common\models\RegHoSoGo::TongKhoiLuongLoGo($data->id);
                        }
                    ],
                    [
                        'attribute'=>'trang_thai_id',
                        'format'=>'raw',
                        'value'=>function($data)
                        {
                            return \common\models\RegHoSoGo::TT_HSG_LABEL()[$data->trang_thai_id];
                        }
                    ],
                    [
                        'attribute'=>'nguoi_duyet',
                        'value'=>function($data){
                            return $data->nguoiDuyet ? $data->nguoiDuyet->fullname : '';
                        }
                    ],
                    [
                        'attribute'=>'ngay_duyet',
                        'value'=>function($data){
                            return ($data->ngay_duyet =='' || $data->ngay_duyet==null) ? '' : date("d/m/Y",strtotime($data->ngay_duyet));
                        }
                    ]
                ]
            ])?>
            <h4 class="panel-title">Thông tin chi tiết</h4>
            <?= \yii\grid\GridView::widget([
                'dataProvider'=>$dataChiTiet,
                'summary'=>'',
                'columns'=>[
                    ['class'=>'yii\grid\SerialColumn'],
                    [
                        'label'=>'Mã lô rừng',
                        'value'=>function($data){
                            return $data->loRung ? $data->loRung->ma : '';
                        }
                    ],
                    [
                        'label'=>'Loài cây',
                        'value'=>function($data)
                        {
                            return \common\models\RegHoSoGoChiTiet::ThongTinLoaiCay($data->reg_ho_so_xin_khai_thac_id)->loaiCayTrong->ten;
                        }
                    ],
                    'cap_duong_kinh_trung_binh',
                    'chieu_dai',
                    'so_luong',
                    'khoi_luong'

                ]
            ])?>
        </div>
        <div class="panel-footer">
            <?php
            if($model->trang_thai_id == \common\models\RegHoSoGo::TT_HSG_DUOCDUYET){
                echo Html::a(Yii::t('backend', 'In hồ sơ'), ['/ho-so-go/in-ho-so','id'=>$model->id], ['class' => 'btn btn-success']);
            }
            ?>

            <?php
            if($model->trang_thai_id==\common\models\RegHoSoGo::TT_HSG_DUOCDUYET){
                echo Html::a(Yii::t('backend','Quay lại'),['ho-so-da-duyet'],['class'=>'btn btn-default']);
            } else {
                echo Html::a(Yii::t('backend','Quay lại'),['ho-so-moi'],['class'=>'btn btn-default']);
            }
            ?>
        </div>
    </div>

</div>
