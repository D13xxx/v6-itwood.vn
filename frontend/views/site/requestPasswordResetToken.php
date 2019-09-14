<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Quên mật khẩu';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="quen-mat-khau">
    <div>&nbsp;</div>
    <div class="col-lg-6 col-lg-offset-5">
        <h1><?php echo Html::encode($this->title) ?></h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6 col-lg-push-3">
                <?php
                if(Yii::$app->session->getFlash('error')){
                    echo '<span style="color: red">'.Yii::$app->session->getFlash('error').'</span>';
                }
                ?>
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?php echo $form->field($model, 'email')->textInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Xin lại mật khẩu', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>

