<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TinhThanh */

$this->title = $model->ma;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Tỉnh thành'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tinh-thanh-view">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"> Xem chi tiết: <?= Html::encode($this->title) ?> </h4>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
//                    'id',
                    'ma',
                    'ten',
                    [
                        'attribute'=>'trang_thai',
                        'value'=>function($data){
                            if($data->trang_thai==1){
                                return Yii::t('backend','Hoạt động');
                            }
                            if($data->trang_thai==0){
                                return Yii::t('backend','Không hoạt động');
                            }
                        }
                    ],
//                    'is_delete',
//                    'nguoi_xoa',
//                    'ngay_xoa',
                ],
            ]) ?>
        </div>
        <div class="panel-footer">
            <?= Html::a(Yii::t('backend', 'Cập nhật'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('backend', 'Xóa'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('backend', 'Bạn có muốn xóa bảng ghi này hay không?'),
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
        </div>
    </div>

</div>
<div class="clearfix"></div>