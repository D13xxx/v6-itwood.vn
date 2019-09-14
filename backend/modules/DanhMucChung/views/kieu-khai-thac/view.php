<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\SysKieuKhaiThac;
/* @var $this yii\web\View */
/* @var $model common\models\SysKieuKhaiThac */

$this->title = $model->ten;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Kiểu khai thác'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sys-kieu-khai-thac-view">

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
                        'attribute'=>'trang_thai',
                        'filter'=>array(1=>Yii::t('backend','Hoạt động'),0=>Yii::t('backend','Không hoạt động')),
                        'value'=>function($data){
                            if($data->trang_thai==SysKieuKhaiThac::TT_ACTIVE){
                                return Yii::t('backend','Hoạt động');
                            }
                            if($data->trang_thai==SysKieuKhaiThac::TT_NOACTIVE){
                                return Yii::t('backend','Không hoạt động');
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