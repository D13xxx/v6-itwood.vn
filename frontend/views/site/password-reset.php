<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/21/2019
 * Time: 10:02 AM
 */
//use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('frontend', 'Đặt lại mật khẩu');
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
                <?php $form = ActiveForm::begin(['id' => 'quen-mat-khau']); ?>
                <?= $form->field($model, 'newPassword')->passwordInput(['autofocus' => true]) ?>
                <?php echo $form->field($model, 'retypePassword')->passwordInput() ?>
                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Đặt lại mật khẩu'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>
