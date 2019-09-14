<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegChuTheToChuc */

$this->title = Yii::t('backend', 'Create Reg Chu The To Chuc');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Reg Chu The To Chucs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-chu-the-to-chuc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
