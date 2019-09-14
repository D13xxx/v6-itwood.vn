<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TinTuc */

$this->title = Yii::t('backend', 'Create Tin Tuc');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Tin Tucs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tin-tuc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
