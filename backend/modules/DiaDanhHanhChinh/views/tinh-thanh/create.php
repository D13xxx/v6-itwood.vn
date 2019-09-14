<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TinhThanh */

$this->title = Yii::t('backend', 'Thêm Tỉnh thành mới');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Tỉnh thành'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tinh-thanh-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
