<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SysKieuTrongRung */

$this->title = Yii::t('frontend', 'Create Sys Kieu Trong Rung');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Sys Kieu Trong Rungs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-kieu-trong-rung-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
