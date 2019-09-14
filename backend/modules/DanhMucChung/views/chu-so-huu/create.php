<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SysChuSoHuu */

$this->title = Yii::t('frontend', 'Create Sys Chu So Huu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Sys Chu So Huus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-chu-so-huu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
