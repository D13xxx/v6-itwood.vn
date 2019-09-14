<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SysLoaiRung */

$this->title = Yii::t('backend', 'Sửa loại rừng: {name}', [
    'name' => $model->ten,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Loại rừng'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ten, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Chỉnh sửa');
?>
<div class="sys-loai-rung-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
