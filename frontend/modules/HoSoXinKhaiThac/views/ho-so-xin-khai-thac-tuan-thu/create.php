<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoXinKhaiThacTuanThu */

$this->title = Yii::t('frontend', 'Create Reg Ho So Xin Khai Thac Tuan Thu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Reg Ho So Xin Khai Thac Tuan Thus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-ho-so-xin-khai-thac-tuan-thu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
