<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\SysTrachNhiemTuanThuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Tránh nhiệm tuân thủ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-trach-nhiem-tuan-thu-index">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?= Html::encode($this->title) ?>
                <?= Html::a(Yii::t('backend', 'Thêm mới'), ['create'], ['class' => 'btn btn-success pull-right btn-xs']) ?>
            </h4>
        </div>
        <div class="panel-body">
            <?php
            $loaiRung = \common\models\SysLoaiRung::find()->active()->all();
            $listLoaiRung = \yii\helpers\ArrayHelper::map($loaiRung,'id','ten');
            ?>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'ten',
                    [
                        'attribute'=>'loai_hinh_chu_the_id',
                        'filter'=>array(1=> Yii::t('backend','Tổ chức'),0=>Yii::t('backend','Hộ gia đình')),
                        'value'=>function($data){
                            if($data->loai_hinh_chu_the_id==1){
                                return Yii::t('backend','Tổ chức');
                            } else {
                                return Yii::t('backend','Hộ gia đình');
                            }
                        }
                    ],
                    [
                        'attribute'=>'loai_rung_id',
                        'filter'=> \kartik\select2\Select2::widget([
                            'model'=>$searchModel,
                            'attribute'=>'loai_rung_id',
                            'data'=> $listLoaiRung,
                            'options'=>['prompt'=>''],
                            'pluginOptions'=>['allowClear'=>true],
                        ]),
                        'value'=>function($data){
                            return $data->loaiRung ? $data->loaiRung->ten : '';
                        }
                    ],
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