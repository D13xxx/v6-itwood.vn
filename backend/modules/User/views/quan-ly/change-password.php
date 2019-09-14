<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\ChangePassword */

$this->title = Yii::t('backend', 'Thay đổi mật khẩu');
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['id' => 'form-change']); ?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title"><?= Html::encode($this->title)?></h4>
    </div>
    <div class="panel-body">
        <?= $form->field($model, 'oldPassword')->passwordInput() ?>
        <?= $form->field($model, 'newPassword')->passwordInput() ?>
        <?= $form->field($model, 'retypePassword')->passwordInput() ?>
    </div>
    <div class="panel-footer">
        <?= Html::submitButton(Yii::t('backend', 'Đổi mật khẩu'), ['class' => 'btn btn-primary', 'name' => 'change-button']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>