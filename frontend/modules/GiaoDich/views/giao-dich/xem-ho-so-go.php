<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/27/2019
 * Time: 2:45 PM
 */
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = Yii::t('frontend','Xem hồ sơ gõ: ').$model->ma;

?>
<div class="xem-ho-so-dang-ky">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"> Xem chi tiết: <?= Html::encode($this->title) ?> </h4>
        </div>
        <div class="panel-body">
            <strong>I. Thông tin khai thác</strong> <br>
            <?= DetailView::widget([
                'model'=>$model,
                'attributes'=>[
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
                            return date("d/m/Y",strtotime($data->ngay_lap));
                        }
                    ]
                ]
            ])?>
            <br>
            <strong>II.Bảng kê chi tiết</strong>
            <?= GridView::widget([
                'dataProvider'=>$dataProvider,
                'summary'=>'',
                'columns'=>[
                    [
                        'label'=>Yii::t('frontend','Mã lô rừng'),
                        'value'=>function($data){
                            return $data->loRung ? $data->loRung->ma : '';
                        }
                    ],
                    'cap_duong_kinh_trung_binh',
                    'chieu_dai',
                    'so_luong',
                    'khoi_luong',
                ]
            ])?>
        </div>
        <div class="panel-footer">
            <?= Html::a(Yii::t('backend', 'Bán lô gỗ'), ['ban-lo-go','id'=>$model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('backend','Quay lại'),['ban-ho-so-go'],['class'=>'btn btn-default'])?>
        </div>
    </div>

</div>
