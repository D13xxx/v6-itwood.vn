<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegQuyenSuDungDat */

$this->title = Yii::t('frontend', 'Điều chỉnh thông tin quyền sử dụng đất');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Danh sách quyền sử dụng đất'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Chỉnh sửa');
?>
<div class="reg-quyen-su-dung-dat-update">

    <?= $this->render('_form', [
        'model' => $model,
        'searchLoRung'=>$searchLoRung,
        'dataLoRung'=>$dataLoRung,
    ]) ?>

</div>
