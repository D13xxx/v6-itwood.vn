<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\SysLoaiRung;
/* @var $this yii\web\View */
/* @var $model common\models\SysTrachNhiemTuanThu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-trach-nhiem-tuan-thu-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'ten')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'loai_hinh_chu_the_id')->dropDownList([
                1=> Yii::t('backend','Tổ chức'),
                2 => Yii::t('backend','Hộ gia đình')
            ]) ?>
            <?php
                $loaiRung = SysLoaiRung::find()->active()->all();
                $listLoaiRung = ArrayHelper::map($loaiRung,'id','ten');
            ?>
            <?= $form->field($model,'loai_rung_id')->widget(Select2::className(),[
                'data'=>$listLoaiRung,
                'options'=>['prompt'=>Yii::t('backend','Chọn loại rừng')],
                'pluginOptions'=>['allowClear'=>true],
            ])?>

            <?= $form->field($model,'trang_thai_id')->dropDownList([
                1=>Yii::t('backend','Hoạt động'),
                0=>Yii::t('backend','Không hoạt động')
            ])?>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('backend', 'Lưu'), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<div class="clearfix"></div>