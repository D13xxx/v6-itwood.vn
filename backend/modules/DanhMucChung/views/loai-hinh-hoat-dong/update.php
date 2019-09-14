<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SysLoaiHinhHoatDong */

$this->title = Yii::t('backend', 'Sửa loại hình hoạt động: {name}', [
    'name' => $model->ten,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Loại hình hoạt động'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ten, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Chỉnh sửa');
?>
<div class="sys-loai-hinh-hoat-dong-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
