<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\SysTrachNhiemTuanThu;
/* @var $this yii\web\View */
/* @var $model common\models\SysTrachNhiemTuanThu */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Trách nhiệm tuân thủ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sys-trach-nhiem-tuan-thu-view">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"> Xem chi tiết: <?= Html::encode($this->title) ?> </h4>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'ten',
                    [
                        'attribute'=>'loai_hinh_chu_the_id',
                        'value'=>function($data){
                            if($data->loai_hinh_chu_the_id==1){
                                return Yii::t('backend','Tổ chức');
                            } else {
                                return Yii::t('backend','Hộ gia đình');
                            }
                        }
                    ],
                    [
                        'attribute'=>'trang_thai_id',
                        'value'=>function($data){
                            if($data->trang_thai_id== SysTrachNhiemTuanThu::TT_ACTIVE){
                                return Yii::t('backend','Hoạt động');
                            }
                            if($data->trang_thai_id == SysTrachNhiemTuanThu::TT_NOACTIVE){
                                return Yii::t('backend','Không hoạt động');
                            }
                        }
                    ],
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