<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/23/2019
 * Time: 5:54 PM
 */
use yii\grid\GridView;

?>
<?= GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        ['class'=>'yii\grid\SerialColumn'],
        [
            'attribute'=>'ly_do_khong_duyet',
            'format'=>'html',
        ],
        [
            'attribute'=>'nguoi_lap',
            'value'=>function($data){
                return $data->nguoiLap ? $data->nguoiLap->fullname : '';
            }
        ],
        [
            'attribute'=>'ngay_lap',
            'value'=>function($data){
                if($data->ngay_lap !=''||$data->ngay_lap!=null){
                    return date("d/m/Y H:i:s",strtotime($data->ngay_lap));
                } else {
                    return '';
                }
            }
        ]
    ]
])?>
