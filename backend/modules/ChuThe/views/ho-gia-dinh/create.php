<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegChuTheHoGiaDinh */

$this->title = Yii::t('backend', 'Create Reg Chu The Ho Gia Dinh');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Reg Chu The Ho Gia Dinhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-chu-the-ho-gia-dinh-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
