<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Banners');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">
    <?php Pjax::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách banner</h4>
        </div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//            'id',
                    'title',
                    [
                        'attribute'=>'images',
                        'format'=>'raw',
                        'value'=>function($data){
                            return $data->images ? Html::img('/uploads/website/banner/'.$data->images,['style'=>'width: 250px; height:auto']) : '';
                        }
                    ],
                    [
                        'attribute'=>'status',
                        'value'=>function($data){
                            return \common\models\Banner::StatusArray()[(int)$data->status];
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
        <div class="panel-footer">
            <?= Html::a(Yii::t('backend', 'Thêm banner'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>

    </div>
    <?php Pjax::end(); ?>
</div>
<div class="clearfix"></div>