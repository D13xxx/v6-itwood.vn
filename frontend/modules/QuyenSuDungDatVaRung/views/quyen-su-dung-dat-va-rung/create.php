<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegQuyenSuDungDat */

$this->title = Yii::t('frontend', 'Tạo quyền sử dụng đất mới');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Danh mục quyền sử dụng đất'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-quyen-su-dung-dat-create">

    <?= $this->render('_form', [
        'model' => $model,
        'searchLoRung'=>$searchLoRung,
        'dataLoRung'=>$dataLoRung,
    ]) ?>

</div>
