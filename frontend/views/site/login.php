<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('frontend', 'Đăng nhập');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div>&nbsp;</div>
    <div class="col-lg-6 col-lg-offset-5">
        <h1><?php echo Html::encode($this->title) ?></h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6 col-lg-push-3">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?php echo $form->field($model, 'password')->passwordInput() ?>
                <?php echo $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Đăng nhập'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

                    <?php echo Html::a(Yii::t('frontend','Quên mật khẩu'),['/site/quen-mat-khau'],['class'=>'pull-right'])?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>
<div class="clearfix"></div>