<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TinhThanh */

$this->title = Yii::t('backend', 'Sửa Tỉnh thành: {name}', [
    'name' => $model->ten,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Tỉnh thành'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ma, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Chỉnh sửa');
?>
<div class="tinh-thanh-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
