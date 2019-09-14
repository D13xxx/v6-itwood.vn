<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\QuanHuyen */

$this->title = Yii::t('backend', 'Chỉnh sửa: {name}', [
    'name' => $model->ma,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Quận huyện'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ma, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Chỉnh sửa');
?>
<div class="quan-huyen-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
