<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SysTrachNhiemTuanThu */

$this->title = Yii::t('backend', 'Chỉnh sửa Trách nhiệm tuân thủ: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Trách nhiệm tuân thủ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Chỉnh sửa');
?>
<div class="sys-trach-nhiem-tuan-thu-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
