<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoGo */

$this->title = Yii::t('frontend', 'Sửa và thêm thông thông tin lô gỗ: {name}', [
    'name' => $model->ma,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Danh sách hồ sơ gỗ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Chỉnh sửa');
?>
<div class="reg-ho-so-go-update">

    <?= $this->render('_form', [
        'model' => $model,
        'hoSoGoChiTiet'=>$hoSoGoChiTiet
    ]) ?>

</div>
