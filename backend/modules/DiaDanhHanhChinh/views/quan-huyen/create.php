<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\QuanHuyen */

$this->title = Yii::t('backend', 'Thêm mới Quận huyện');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Quận huyện'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quan-huyen-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
