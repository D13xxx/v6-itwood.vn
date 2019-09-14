<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoXinKhaiThacTuanThu */

$this->title = Yii::t('frontend', 'Update Reg Ho So Xin Khai Thac Tuan Thu: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Reg Ho So Xin Khai Thac Tuan Thus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Update');
?>
<div class="reg-ho-so-xin-khai-thac-tuan-thu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
