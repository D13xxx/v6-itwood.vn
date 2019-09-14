<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/27/2019
 * Time: 2:29 PM
 */
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;

$this->title = Yii::t('frontend','Lô rừng đang có giao dịch');
?>
<div class="ban-rung">

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
//                    [
//                        'class'=>'yii\grid\CheckboxColumn'
//                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{xem-ho-so-dang-ky}',
                        'buttons'=>[
                            'xem-ho-so-dang-ky'=>function($url,$data){
                                $url = Url::to(['/giao-dich/giao-dich/xem-ho-so-mua','id'=>$data->id]);
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',$url,['title'=>Yii::t('frontend','Xem hồ sơ đăng ký khait thác')]);
                            }
                        ]
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="panel-footer">
        </div>
    </div>

</div>
