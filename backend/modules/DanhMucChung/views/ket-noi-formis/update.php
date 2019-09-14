<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegSystemFormis */

$this->title = Yii::t('backend', 'Sửa kết nối đến FORMIS:') . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Kết nối với FORMIS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Chỉnh sửa');
?>
<div class="reg-system-formis-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
