<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\RegSystemFormisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Kết nối với FORMIS');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-system-formis-index">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?= Html::encode($this->title) ?>
                <?= Html::a(Yii::t('backend', 'Thêm mới'), ['create'], ['class' => 'btn btn-success pull-right btn-xs']) ?>
            </h4>
        </div>
        <div class="panel-body">
            <?php Pjax::begin(); ?>
            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'url:url',
                    'bang_du_lieu',
                    [
                        'attribute'=>'ngay_khoi_tao',
                        'value'=>function($data){
                            return date("d/m/Y",strtotime($data->ngay_khoi_tao));
                        }
                    ],
                    [
                        'attribute'=>'trang_thai_id',
                        'value'=>function($data){
                            return $data->trang_thai_id==1 ? 'Kích hoạt' : 'Không kích hoạt';
                        }
                    ],

                    // 'nguoi_khoi_tao',

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