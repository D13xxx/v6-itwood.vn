<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoXnKhaiThacKhongDuyet */

$this->title = Yii::t('backend', 'Create Reg Ho So Xn Khai Thac Khong Duyet');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Reg Ho So Xn Khai Thac Khong Duyets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-ho-so-xn-khai-thac-khong-duyet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
