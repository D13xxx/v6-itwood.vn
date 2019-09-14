<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegLoRung */

$this->title = Yii::t('frontend', 'Thêm thông tin lô rừng mới');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Lô rừng'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-lo-rung-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
