<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\SysLoaiRung;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\SysLoaiRungSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Loại rừng');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-loai-rung-index">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?= Html::encode($this->title) ?>
                <?= Html::a(Yii::t('backend', 'Thêm mới'), ['create'], ['class' => 'btn btn-success pull-right btn-xs']) ?>
            </h4>
        </div>
        <div class="panel-body">
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'ten',
                    [
                        'attribute'=>'trang_thai_id',
                        'value'=>function($data){
                            if($data->trang_thai_id==SysLoaiRung::TT_ACTIVE){
                                return Yii::t('backend','Hoạt động');
                            }
                            if($data->trang_thai_id == SysLoaiRung::TT_NOACTIVE){
                                return Yii::t('backend','Không hoạt động');
                            }
                        }
                    ],
                    'nguoi_tao',
                    [
                        'attribute'=>'ngay_tao',
                        'value'=>function($data){
                            return date("d/m/Y H:i:s", strtotime($data->ngay_tao));
                        }
                    ],
                    //'nguoi_sua',
                    //'ngay_sua',
                    //'ma',

                    ['class' => 'yii\grid\ActionColumn'],
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