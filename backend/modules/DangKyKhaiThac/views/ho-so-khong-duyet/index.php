<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;

$this->title = Yii::t('backend', 'Hồ sơ đăng ký khai thác đã duyệt');
?>
<div class="panel panel-warning">
    <div class="panel-heading">
        <h4 class="panel-title">
            <?= Html::encode($this->title) ?>
        </h4>
    </div>
    <div class="panel-body">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'ma',
                'dien_tich_khai_thac',
                [
                    'attribute'=>'ngay_bat_dau',
                    'value'=>function($data){
                        return ($data->ngay_bat_dau!='' || $data->ngay_bat_dau!=null) ? date("d/m/Y",strtotime($data->ngay_bat_dau)) : '';
                    }
                ],
                [
                    'attribute'=>'ngay_ket_thuc',
                    'value'=>function($data){
                        return ($data->ngay_ket_thuc!='' || $data->ngay_ket_thuc!=null) ? date("d/m/Y",strtotime($data->ngay_ket_thuc)) : '';
                    }
                ],
                [
                    'attribute'=>'ngay_lap',
                    'value'=>function($data){
                        return ($data->ngay_lap!='' || $data->ngay_lap!=null) ? date("d/m/Y",strtotime($data->ngay_lap)) : '';
                    }
                ],
                [
                    'attribute'=>'chu_the_id',
                    'value'=>function($data){
                        if($data->loai_hinh_chu_the_id==1){
                            $chuThe = \common\models\RegChuTheToChuc::find()->where(['id'=>$data->chu_the_id])->one();
                            return $chuThe->ten_to_chuc;
                        } else {
                            $chuThe = \common\models\RegChuTheHoGiaDinh::find()->where(['id'=>$data->chu_the_id])->one();
                            return $chuThe->ten;
                        }
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template'=>'{view}'
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
<div class="clearfix"></div>