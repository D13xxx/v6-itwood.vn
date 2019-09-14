<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\SysLoaiRung;
/* @var $this yii\web\View */
/* @var $model common\models\SysLoaiRung */

$this->title = $model->ten;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Loại rừng'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sys-loai-rung-view">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"> Xem chi tiết: <?= Html::encode($this->title) ?> </h4>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
//                    'id',
                    'ten',
                    [
                        'attribute'=>'trang_thai_id',
                        'value'=>function($data){
                            if($data->trang_thai_id==SysLoaiRung::TT_ACTIVE){
                                return Yii::t('backend','Hoạt động');
                            }
                            if($data->trang_thai_id == SysLoaiRung::TT_NOACTIVE){
                                return Yii::t('backend','Không hoạt động');
                            }
                        }
                    ],
                    'nguoi_tao',
                    [
                        'attribute'=>'ngay_tao',
                        'value'=>function($data){
                            return date("d/m/Y H:i:s", strtotime($data->ngay_tao));
                        }
                    ],
                    'nguoi_sua',
                    [
                        'attribute'=>'ngay_sua',
                        'value'=>function($data){
                            if($data->ngay_sua!='' || $data->ngay_sua!=null){
                                return date("d/m/Y H:i:s", strtotime($data->ngay_sua));
                            }
                            else {
                                return '';
                            }
                        }
                    ],
                ],
            ]) ?>
        </div>
        <div class="panel-footer">
            <?= Html::a(Yii::t('backend', 'Thêm mới'), ['create'], ['class' => 'btn btn-success']) ?>
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