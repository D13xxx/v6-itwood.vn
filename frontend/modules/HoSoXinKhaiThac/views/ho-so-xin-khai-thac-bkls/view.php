<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoXinKhaiThacBkls */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Reg Ho So Xin Khai Thac Bkls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reg-ho-so-xin-khai-thac-bkls-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('frontend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('frontend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('frontend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'reg_lo_rung_id',
            'dien_tich_khai_thac',
            'phuong_thuc_khai_thac_id',
            'tuoi_rung_khai_thac',
            'so_cay_hien_tai',
            'd13_cay_pho_bien',
            'san_luong_du_kien',
            'phuong_an_bao_ve_rung',
            'trang_thai_id',
            'reg_ho_so_xin_khai_thac_id',
        ],
    ]) ?>

</div>
