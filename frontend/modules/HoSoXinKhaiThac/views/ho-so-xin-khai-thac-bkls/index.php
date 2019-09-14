<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\RegHoSoXinKhaiThacBklsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Reg Ho So Xin Khai Thac Bkls');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-ho-so-xin-khai-thac-bkls-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('frontend', 'Create Reg Ho So Xin Khai Thac Bkls'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'reg_lo_rung_id',
            'dien_tich_khai_thac',
            'phuong_thuc_khai_thac_id',
            'tuoi_rung_khai_thac',
            //'so_cay_hien_tai',
            //'d13_cay_pho_bien',
            //'san_luong_du_kien',
            //'phuong_an_bao_ve_rung',
            //'trang_thai_id',
            //'reg_ho_so_xin_khai_thac_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
