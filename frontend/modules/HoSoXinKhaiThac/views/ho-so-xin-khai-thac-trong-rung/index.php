<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\RegHoSoXinKhaiThacTrongRungSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Reg Ho So Xin Khai Thac Trong Rungs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-ho-so-xin-khai-thac-trong-rung-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('frontend', 'Create Reg Ho So Xin Khai Thac Trong Rung'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'reg_lo_rung_id',
            'loai_cay_trong_id',
            'phuong_thuc_trong_id',
            'nam_trong',
            //'loai_von_dau_tu_id',
            //'chu_so_huu',
            //'reg_ho_so_xin_khai_thac_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
