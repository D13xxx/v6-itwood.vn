<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoXinKhaiThac */

$this->title = Yii::t('frontend', 'Chỉnh sửa Hồ sơ xin khai thác: {name}', [
    'name' => $model->ma,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Danh mục hồ sơ xin khai thác'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ma, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Chỉnh sửa');
?>
<div class="reg-ho-so-xin-khai-thac-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
