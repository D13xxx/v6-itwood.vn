<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\RegHoSoGoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
if(Yii::$app->controller->action->id=='ho-so-da-duyet'){
    $this->title = Yii::t('frontend', 'Danh mục hồ so gỗ đã duyệt');
}
if(Yii::$app->controller->action->id=='ho-so-moi'){
    $this->title = Yii::t('frontend', 'Danh mục hồ so gỗ mới');
}

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-ho-so-go-index">

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

//                    'id',
                    'ma',
//                    'reg_chu_the_id',
                    [
                        'attribute'=>'ngay_lap',
                        'value'=>function($data){
                            return ($data->ngay_lap!=''||$data->ngay_lap!=null) ? date("d/m/Y H:i:s", strtotime($data->ngay_lap)) : '';
                        }
                    ],
                    [
                        'label'=>Yii::t('frontend','Tổng khối lượng gỗ (m3)'),
                        'value'=>function($data){
                            return (\common\models\RegHoSoGo::TongKhoiLuongLoGo($data->id)=='') ? 0 : \common\models\RegHoSoGo::TongKhoiLuongLoGo($data->id);
                        }
                    ],
                    [
                        'attribute'=>'trang_thai_id',
                        'format'=>'html',
                        'filter'=>\common\models\RegHoSoGo::TT_HSG_ARRAY_NEW(),
                        'value'=>function($data){
                            return \common\models\RegHoSoGo::TT_HSG_LABEL()[(int)$data->trang_thai_id];
                        }
                    ],
                    //'nguoi_duyet',
                    //'ngay_duyet',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'visibleButtons'=>[
                            'update'=>function($data){
                                return ($data->trang_thai_id==\common\models\RegHoSoGo::TT_HSG_MOI || $data->trang_thai_id==\common\models\RegHoSoGo::TT_HSG_KHONGDUYET);
                            },
                            'delete'=>function($data){
                                return ($data->trang_thai_id==\common\models\RegHoSoGo::TT_HSG_MOI || $data->trang_thai_id==\common\models\RegHoSoGo::TT_HSG_KHONGDUYET);
                            }
                        ]
                    ],
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