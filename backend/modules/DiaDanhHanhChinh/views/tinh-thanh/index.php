<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\TinhThanhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Danh mục tỉnh thành');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tinh-thanh-index">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?= Html::encode($this->title) ?>
                <?= Html::a(Yii::t('backend', 'Thêm tỉnh thành'), ['create'], ['class' => 'btn btn-success pull-right btn-xs']) ?>
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
                    'ten',
//                    'trang_thai',
//                    'is_delete',
                    //'nguoi_xoa',
                    //'ngay_xoa',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="panel-footer">
            <?= Html::a(Yii::t('backend', 'Thêm tỉnh thành'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

</div>
<div class="clearfix"></div>