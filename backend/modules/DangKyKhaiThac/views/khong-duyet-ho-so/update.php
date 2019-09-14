<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoXnKhaiThacKhongDuyet */

$this->title = Yii::t('backend', 'Update Reg Ho So Xn Khai Thac Khong Duyet: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Reg Ho So Xn Khai Thac Khong Duyets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="reg-ho-so-xn-khai-thac-khong-duyet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
