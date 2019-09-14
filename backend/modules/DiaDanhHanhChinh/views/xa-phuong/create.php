<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\XaPhuong */

$this->title = Yii::t('backend', 'Create Xa Phuong');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Xa Phuongs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xa-phuong-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
