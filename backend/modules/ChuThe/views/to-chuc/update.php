<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegChuTheToChuc */

$this->title = Yii::t('backend', 'Update Reg Chu The To Chuc: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Reg Chu The To Chucs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="reg-chu-the-to-chuc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
