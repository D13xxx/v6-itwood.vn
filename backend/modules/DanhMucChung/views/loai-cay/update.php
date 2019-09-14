<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SysLoaiCay */

$this->title = Yii::t('backend', 'Sửa loài cây: {name}', [
    'name' => $model->ten,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Loài cây'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ten, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Chỉnh sửa');
?>
<div class="sys-loai-cay-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
