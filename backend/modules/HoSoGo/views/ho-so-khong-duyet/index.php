<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/26/2019
 * Time: 3:42 PM
 */
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title=Yii::t('backend','Danh sách hồ sơ gỗ cần duyệt');
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
            'dataProvider'=>$dataProvider,
            'columns'=>[
                ['class'=>'yii\grid\SerialColumn'],
                'ma',
                [
                    'attribute'=>'ngay_lap',
                    'value'=>function($data){
                        return date("d/m/Y",strtotime($data->ngay_lap));
                    }
                ],
                [
                    'label'=>Yii::t('backend','Khối lượng lô gỗ (m3)'),
                    'value'=>function($data){
                        return \common\models\RegHoSoGo::TongKhoiLuongLoGo($data->id);
                    }
                ],
                [
                    'attribute'=>'reg_chu_the_id',
                    'value'=>function($data){
                        if($data->reg_loai_hinh_chu_the==1){
                            $chuThe = \common\models\RegChuTheToChuc::find()->where(['id'=>$data->reg_chu_the_id])->one();
                            return $chuThe->ten_to_chuc;
                        } else {
                            $chuThe = \common\models\RegChuTheHoGiaDinh::find()->where(['id'=>$data->reg_chu_the_id])->one();
                            return $chuThe->ten;
                        }
                    }
                ],
                [
                    'class'=>'yii\grid\ActionColumn',
                    'template'=>'{view}'
                ]
            ]
        ])?>
        <?php Pjax::end(); ?>
    </div>
</div>
