<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\TinhThanh;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\QuanHuyen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quan-huyen-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title"><?= Html::encode($this->title) ?></h4>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'ma')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'ten')->textInput(['maxlength' => true]) ?>

                <?php
                $tinhThanh = TinhThanh::find()->active()->all();
                $listTinhThanh = ArrayHelper::map($tinhThanh,'id','ten');
                ?>
                <?= $form->field($model, 'tinh_thanh_id')->widget(Select2::className(),[
                    'data'=>$listTinhThanh,
                    'options'=>['prompt'=>Yii::t('backend','Lựa chọn Tỉnh thành')],
                    'pluginOptions'=>['allowClear'=>true]
                ]); ?>
            </div>
            <div class="panel-footer">
                <?= Html::submitButton(Yii::t('backend', 'Lưu'), ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
<div class="clearfix"></div>