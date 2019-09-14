<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/20/2019
 * Time: 11:07 AM
 */
use yii\grid\GridView;
$dataProvider = \common\models\RegHoSoXnKhaiThacKhongDuyet::KhongDuyet($idHoSoKhaiThac);

echo GridView::widget([
   'dataProvider'=>$dataProvider,
   'columns'=>[
       ['class'=>'yii\grid\SerialColumn'],
       'ly_do:html',
       [
           'attribute'=>'nguoi_lap',
           'value'=>function($data){
                return $data->nguoiDung ? $data->nguoiDung->fullname : '';
           }
       ],
       [
           'attribute'=>'ngay_lap',
           'value'=>function($data){
                return ($data->ngay_lap !='' || $data->ngay_lap!=null) ? date("d/m/Y H:i:s",strtotime($data->ngay_lap)) : '';
           }
       ]
   ]
]);
?>

