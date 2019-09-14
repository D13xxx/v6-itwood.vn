<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SysLoaiRung */

$this->title = Yii::t('backend', 'Thêm loại rừng');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Loại rừng'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-loai-rung-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
