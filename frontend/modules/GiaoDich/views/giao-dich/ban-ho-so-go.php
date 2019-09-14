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

$this->title = Yii::t('frontend','Danh sách Hồ sơ đăng ký khai thác');
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
                    [
                        'label'=>'Khối lượng lô gỗ',
                        'value'=>function($data){
                            return \common\models\RegHoSoGo::TongKhoiLuongLoGo($data->id);
                        }
                    ],
                    [
                        'attribute'=>'ngay_lap',
                        'value'=>function($data){
                            return ($data->ngay_lap!='' || $data->ngay_lap!=null) ? date("d/m/Y",strtotime($data->ngay_lap)) : '';
                        }
                    ],

                    [
                        'class'=>'yii\grid\CheckboxColumn'
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{xem-ho-so-go}',
                        'buttons'=>[
                            'xem-ho-so-go'=>function($url,$data){
                                $url = Url::to(['/giao-dich/giao-dich/xem-ho-so-go','id'=>$data->id]);
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
