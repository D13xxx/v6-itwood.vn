<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\RegHoSoXnKhaiThacKhongDuyetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Reg Ho So Xn Khai Thac Khong Duyets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-ho-so-xn-khai-thac-khong-duyet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create Reg Ho So Xn Khai Thac Khong Duyet'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'reg_ho_so_xin_khai_thac_id',
            'ly_do:ntext',
            'nguoi_lap',
            'ngay_lap',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
