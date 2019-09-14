<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SysChuSoHuu */

$this->title = Yii::t('frontend', 'Update Sys Chu So Huu: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Sys Chu So Huus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Update');
?>
<div class="sys-chu-so-huu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
