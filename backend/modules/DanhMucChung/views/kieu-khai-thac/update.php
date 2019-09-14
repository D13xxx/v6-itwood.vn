<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SysKieuKhaiThac */

$this->title = Yii::t('backend', 'Chỉnh sửa kiểu khai thác: {name}', [
    'name' => $model->ten,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Kiểu khai thác'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ten, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Chỉnh sửa');
?>
<div class="sys-kieu-khai-thac-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
