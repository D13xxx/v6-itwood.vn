<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\RegHoSoXinKhaiThacSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Danh sách hồ sơ đăng ký khai thác đã duyệt');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-ho-so-xin-khai-thac-index">

    <div class="panel panel-primary">
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
                        'attribute'=>'trang_thai_id',
                        'filter'=>\common\models\RegHoSoXinKhaiThac::TT_HOSO_ARRAY(),
                        'value'=>function($data){
                            return \common\models\RegHoSoXinKhaiThac::TT_HOSO_ARRAY()[$data->trang_thai_id];
                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn','template'=>'{view}'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
