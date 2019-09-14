<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SysQuyenSuDungDat */

$this->title = Yii::t('backend', 'Update Sys Quyen Su Dung Dat: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Sys Quyen Su Dung Dats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="sys-quyen-su-dung-dat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
