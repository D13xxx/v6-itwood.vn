<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="banner-view">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">Thông tin banner</h4>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
//                    'id',
                    'title',
                    [
                        'attribute'=>'images',
                        'format'=>'raw',
                        'value'=>function($data){
                            return $data->images ? Html::img('/uploads/website/banner/'.$data->images,['style'=>'width: 400px; height:auto']) : '';
                        }
                    ],
                    [
                        'attribute'=>'status',
                        'value'=>function($data){
                            return \common\models\Banner::StatusArray()[(int)$data->status];
                        }
                    ],
                    [
                        'attribute'=>'created_by',
                        'value'=>function($data){
                            return $data->nguoiTao ? $data->nguoiTao->fullname : '';
                        }
                    ],
                    [
                        'attribute'=>'updated_by',
                        'value'=>function($data){
                            return $data->nguoiCapNhat ? $data->nguoiCapNhat->fullname : '';
                        }
                    ],
                    [
                        'attribute'=>'created_at',
                        'value'=>function($data){
                            return $data->created_at ? date("d/m/Y",$data->created_at) : '';
                        }
                    ],
                    [
                        'attribute'=>'updated_at',
                        'value'=>function($data){
                            return $data->updated_at ? date("d/m/Y",$data->updated_at) : '';
                        }
                    ],
                ],
            ]) ?>
        </div>
        <div class="panel-footer">
            <?= Html::a(Yii::t('backend', 'Chỉnh sửa'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('backend', 'Xóa'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('backend', 'Bạn có muốn xóa banner này hay không?'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>

</div>
