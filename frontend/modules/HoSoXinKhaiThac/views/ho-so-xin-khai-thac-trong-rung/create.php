<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoXinKhaiThacTrongRung */

$this->title = Yii::t('frontend', 'Create Reg Ho So Xin Khai Thac Trong Rung');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Reg Ho So Xin Khai Thac Trong Rungs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-ho-so-xin-khai-thac-trong-rung-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
