<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\RegHoSoXinKhaiThacTuanThuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Reg Ho So Xin Khai Thac Tuan Thus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-ho-so-xin-khai-thac-tuan-thu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('frontend', 'Create Reg Ho So Xin Khai Thac Tuan Thu'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'reg_ho_so_xin_khai_thac_id',
            'reg_trach_nhiem_tuan_thu_id',
            'gia_tri',
            'file_dinh_kem',
            //'reg_lo_rung_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
