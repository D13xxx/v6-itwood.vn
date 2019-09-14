<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SysLoaiRung */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-loai-rung-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'ten')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('backend', 'Lưu'), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<div class="clearfix"></div>