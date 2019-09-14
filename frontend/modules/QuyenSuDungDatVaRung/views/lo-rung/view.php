<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RegLoRung */

$this->title = 'Thông tin lô rừng '.$model->ma;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Danh sách lô rừng'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reg-lo-rung-view">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"> Xem chi tiết: <?= Html::encode($this->title) ?> </h4>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'ma',
                    'tieu_khu',
                    'khoanh',
                    'lo',
                    'dia_chi',
                    [
                        'attribute'=>'tinh_thanh_id',
                        'value'=>function($data)
                        {
                            return $data->tinhThanh ? $data->tinhThanh->ten : '';
                        }
                    ],
                    [
                        'attribute'=>'quan_huyen_id',
                        'value'=>function($data)
                        {
                            return $data->quanHuyen ? $data->quanHuyen->ten : '';
                        }
                    ],
                    [
                        'attribute'=>'xa_phuong_id',
                        'value'=>function($data)
                        {
                            return $data->xaPhuong ? $data->xaPhuong->ten : '';
                        }
                    ],
                    [
                        'attribute'=>'loai_rung_id',
                        'value'=>function($data){
                            return $data->loaiRung ? $data->loaiRung->ten : '';
                        }
                    ],
                    [
                        'attribute'=>'trang_thai_id',
                        'value'=>function($data){
                            return \common\models\RegLoRung::TT_ARRAY()[(int)$data->trang_thai_id];
                        }
                    ],
                    [
                        'attribute'=>'ngay_duyet',
                        function($data){
                            return ($data->ngay_duyet !=''||$data->ngay_duyet!=null) ? date("d/m/Y",strtotime($data->ngay_duyet)) : null;
                        }
                    ],
                    [
                        'attribute'=>'quyen_sdd_id',
                        'value'=>function($data){
                            return $data->quyenSuDungDat ? 'Mã: '.$data->quyenSuDungDat->ma.'- Số văn bản: '.$data->quyenSuDungDat->so_van_ban : '';
                        }
                    ],
                ],
            ]) ?>
        </div>
        <div class="panel-footer">
            <?php
            if($model->trang_thai_id != \common\models\RegLoRung::TT_RUNGDENGHIDUYET && $model->trang_thai_id!=\common\models\RegLoRung::TT_RUNGDUOCDUYET){
                echo Html::a(Yii::t('backend', 'Cập nhật'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                echo ' ';
                echo Html::a(Yii::t('backend', 'Xóa'),
                    ['delete', 'id' => $model->id],
                    [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('backend', 'Bạn có muốn xóa bảng ghi này hay không?'),
                            'method' => 'post'
                        ]
                ]);
            }
            ?>
            <?php
            if($model->trang_thai_id==\common\models\RegLoRung::TT_RUNGDUOCDUYET){
                echo Html::a(Yii::t('backend', 'In hồ sơ'), ['/quyen-su-dung-dat-va-rung/in-ho-so/lo-rung','id'=>$model->id], ['class' => 'btn btn-success']);
            }
            ?>
            <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
        </div>
    </div>

</div>
