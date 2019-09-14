<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\SysKieuKhaiThac;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\SysKieuKhaiThacSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Kiểu khai thác');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-kieu-khai-thac-index">

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
                        'attribute'=>'trang_thai',
                        'filter'=>array(1=>Yii::t('backend','Hoạt động'),0=>Yii::t('backend','Không hoạt động')),
                        'value'=>function($data){
                            if($data->trang_thai==SysKieuKhaiThac::TT_ACTIVE){
                                return Yii::t('backend','Hoạt động');
                            }
                            if($data->trang_thai==SysKieuKhaiThac::TT_NOACTIVE){
                                return Yii::t('backend','Không hoạt động');
                            }
                        }
                    ],

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