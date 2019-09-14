<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SysQuyenSuDungDat */

$this->title = Yii::t('backend', 'Create Sys Quyen Su Dung Dat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Sys Quyen Su Dung Dats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-quyen-su-dung-dat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
