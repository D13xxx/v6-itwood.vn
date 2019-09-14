<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SysLoaiCay */

$this->title = Yii::t('backend', 'Thêm loài cây');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Loài cây'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-loai-cay-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
