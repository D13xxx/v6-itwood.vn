<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/20/2019
 * Time: 11:30 AM
 */
use yii\helpers\Html;

$this->title = Yii::t('backend', 'Thay đổi mật khẩu');
?>
<?php $form = \yii\widgets\ActiveForm::begin(['id' => 'form-change']); ?>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="panel-title"><?= Html::encode($this->title)?></h4>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'oldPassword')->passwordInput()->label('Mật khẩu cũ') ?>
            <?= $form->field($model, 'newPassword')->passwordInput()->label('Mật khẩu mới') ?>
            <?= $form->field($model, 'retypePassword')->passwordInput()->label('Nhập lại mật khẩu') ?>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('frontend', 'Đổi mật khẩu'), ['class' => 'btn btn-primary', 'name' => 'change-button']) ?>
        </div>
    </div>
<?php \yii\widgets\ActiveForm::end(); ?>