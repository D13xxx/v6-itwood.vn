<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SysLoaiVonDauTu */

$this->title = Yii::t('frontend', 'Create Sys Loai Von Dau Tu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Sys Loai Von Dau Tus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-loai-von-dau-tu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
