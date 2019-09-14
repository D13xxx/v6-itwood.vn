<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RegSystemFormis */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="reg-system-formis-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="panel-body">
            <?php echo $form->errorSummary($model); ?>

            <?php echo $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($model, 'bang_du_lieu')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($model, 'trang_thai_id')->dropDownList([
                '1'=>'Kích hoạt', 0=>'Không kích hoạt'
            ]) ?>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('backend', 'Lưu'), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
