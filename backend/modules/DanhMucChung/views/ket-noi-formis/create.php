<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RegSystemFormis */

$this->title = Yii::t('backend', 'Tạo kết nối đến FORMIS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Kết nối vơi FORMIS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-system-formis-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
