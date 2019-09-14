<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SysTrachNhiemTuanThu */

$this->title = Yii::t('backend', 'Thêm trách nhiệm tuân thủ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Trách nhiệm tuân thủ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-trach-nhiem-tuan-thu-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
