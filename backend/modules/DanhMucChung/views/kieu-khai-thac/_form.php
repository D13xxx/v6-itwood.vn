<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SysKieuKhaiThac */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-kieu-khai-thac-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'ten')->textInput(['maxlength' => true]) ?>
            <?php
            if(!$model->isNewRecord){
                echo $form->field($model, 'trang_thai')->widget(\kartik\select2\Select2::className(),[
                    'data'=>array(1=>Yii::t('backend','Hoạt động'),0=>Yii::t('backend','Không hoạt động')),
                    'options'=>['prompt'=>Yii::t('backend','Trạng thái')],
                    'pluginOptions'=>['allowCLear'=>true],
                ]);
            }
            ?>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('backend', 'Lưu'), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<div class="clearfix"></div>