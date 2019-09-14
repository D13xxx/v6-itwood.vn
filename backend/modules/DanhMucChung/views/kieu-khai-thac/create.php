<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SysKieuKhaiThac */

$this->title = Yii::t('backend', 'Thêm kiểu khai thác');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Kiểu khai thác'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-kieu-khai-thac-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
