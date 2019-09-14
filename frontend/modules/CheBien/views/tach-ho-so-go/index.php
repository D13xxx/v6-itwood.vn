<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/28/2019
 * Time: 3:42 PM
 */
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;

$this->title = Yii::t('frontend','Danh sách Hồ sơ gỗ');

?>
<div class="danh-sach-ho-so-go">

    <div class="panel panel-primary">
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
                    'ma',
                    [
                        'label'=>Yii::t('frontend','Khối lượng lô gỗ'),
                        'value'=>function($data){
                            return \common\models\RegHoSoGo::TongKhoiLuongLoGo($data->id);
                        },
                    ],
                    [
                        'attribute'=>'ngay_lap',
                        'value'=>function($data){
                            return date("d/m/Y",strtotime($data->ngay_lap));
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
        <div class="panel-footer">
        </div>
    </div>

</div>
