<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\TinTucSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Tin Tucs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tin-tuc-index">
    <?php Pjax::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">Danh mục tin tức</h4>
        </div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute'=>'anh_dai_dien',
                        'format'=>'raw',
                        'value'=>function($data){
                            return $data->anh_dai_dien ? Html::img('/uploads/website/tin-tuc/'.$data->anh_dai_dien,['style'=>'width: 120px; height:120px']) : '';
                        }
                    ],
                    'tieu_de',
                    'tom_tat',
//                    'chi_tiet:ntext',
                    //'status',
                    [
                        'attribute'=>'created_at',
                        'value'=>function($data){
                            return $data->created_at ? date("d/m/Y",$data->created_at) : '';
                        }
                    ],
                    //'updated_at',
                    //'created_by',
                    //'updated_by',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
        <div class="panel-footer">
            <?= Html::a(Yii::t('backend', 'Thêm tin tức'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
<div class="clearfix"></div>