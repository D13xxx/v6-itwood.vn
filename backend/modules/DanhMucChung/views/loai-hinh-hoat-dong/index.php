<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\SysLoaiHinhHoatDongSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Loại hình hoạt động');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-loai-hinh-hoat-dong-index">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?= Html::encode($this->title) ?>
                <?= Html::a(Yii::t('backend', 'Thêm mới'), ['create'], ['class' => 'btn btn-success pull-right btn-xs']) ?>
            </h4>
        </div>
        <div class="panel-body">
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                    'ten',
//                    'trang_thai_id',
                    [
                        'attribute'=>'nguoi_tao_id'
                    ],
                    [
                        'attribute'=>'ngay_tao',
                        'value'=>function($data){
                            return date("d/m/Y H:i:s",strtotime($data->ngay_tao));
                        }
                    ],
                    //'nguoi_sua_id',
                    //'ngay_sua',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="panel-footer">
            <?= Html::a(Yii::t('backend', 'Thêm mới'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

</div>
<div class="clearfix"></div>