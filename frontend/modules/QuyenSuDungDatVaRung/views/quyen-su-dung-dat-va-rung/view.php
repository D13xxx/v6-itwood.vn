<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RegQuyenSuDungDat */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Quyền sử dụng đất'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reg-quyen-su-dung-dat-view">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"> Xem chi tiết: <?= Html::encode($this->title) ?> </h4>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute'=>'quyen_su_dung_dat_id',
                        'value'=>function($data){
                            return $data->loaiQuyenSuDungDat ? $data->loaiQuyenSuDungDat->ten : '';
                        }
                    ],
                    'so_van_ban',
                    'ngay_ban_hanh',
                    'so_vao_so',
                    'co_quan_ban_hanh',
                    [
                        'attribute'=>'trang_thai_id',
                        'format'=>'html',
                        'value'=>function($data){
                            return \common\models\RegQuyenSuDungDat::TT_ARRAY()[(int)$data->trang_thai_id];
                        }
                    ],
                ],
            ]) ?>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title"><?= Yii::t('frontend','Danh sách rừng trồng')?></h4>
                </div>
                <div class="panel-body">
                    <?= \yii\grid\GridView::widget([
                        'dataProvider'=>$dataLoRung,
                        'filterModel'=>$searchLoRung,
                        'columns'=>[
                            ['class'=>'yii\grid\SerialColumn'],
                            'ma',
                            'tieu_khu',
                            'khoanh',
                            'lo',
                            'dia_chi',
                            [
                                'attribute'=>'trang_thai_id',
                                'format'=>'html',
                                'value'=>function($data){
                                    return \common\models\RegLoRung::TT_ARRAY()[(int)$data->trang_thai_id];
                                }
                            ],
                        ]
                    ])?>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <?= Html::a(Yii::t('backend', 'Thêm mới'), ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('backend', 'Cập nhật'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php
                if(\common\models\RegQuyenSuDungDat::DemLoRung($model->id) <=0){ ?>
                    <?= Html::a(Yii::t('backend', 'Xóa'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('backend', 'Bạn có muốn xóa bảng ghi này hay không?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php }
            ?>
            <?php
            if($model->trang_thai_id==\common\models\RegQuyenSuDungDat::TT_ACTIVE){
                echo Html::a(Yii::t('backend', 'In hồ sơ'), ['/quyen-su-dung-dat-va-rung/in-ho-so/quyen-su-dung-dat','id'=>$model->id], ['class' => 'btn btn-success']);
            }
            ?>
            <?= Html::a(Yii::t('backend','Quay lại'),Yii::$app->request->referrer,['class'=>'btn btn-default'])?>
        </div>
    </div>

</div>
