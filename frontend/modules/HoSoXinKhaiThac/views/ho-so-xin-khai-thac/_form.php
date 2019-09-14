<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoXinKhaiThac */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-ho-so-xin-khai-thac-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="panel-body">
            <div class="col-sm-12">
                <?= $form->field($model, 'ngay_bat_dau')->widget(\kartik\widgets\DatePicker::className(),[
                    'pluginOptions'=>[
                        'format'=>'dd/mm/yyyy',
                        'autoClose'=>true,
                    ]
                ]) ?>

                <?= $form->field($model, 'ngay_ket_thuc')->widget(\kartik\widgets\DatePicker::className(),[
                    'pluginOptions'=>[
                        'format'=>'dd/mm/yyyy',
                        'autoClose'=>true,
                    ]
                ]) ?>


            </div>
            <?php
            $tinhThanh = \common\models\TinhThanh::find()->active()->all();
            $listTinhThanh = \yii\helpers\ArrayHelper::map($tinhThanh,'id','ten');
            ?>
            <div class="col-sm-4">
                <?= $form->field($model, 'tinh_thanh_id')->widget(\kartik\select2\Select2::className(),[
                    'data'=>$listTinhThanh,
                    'options'=>[
                        'prompt'=>Yii::t('frontend','Lựa chọn tỉnh thành'),
                        'onchange'=>'
                        $.get( "'.\yii\helpers\Url::toRoute('/site/danh-sach-quan-huyen').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'quan_huyen_id').'" ).html( data );
                            }
                        );
                    '
                    ],
                    'pluginOptions'=>['allowClear'=>true]
                ]) ?>
            </div>
            <div class="col-sm-4">
                <?php
                if(is_null($model->tinh_thanh_id))
                {
                    $listQuanHuyen=array();
                }else {
                    $quanHuyen=\common\models\QuanHuyen::find()->where(['tinh_thanh_id'=>$model->tinh_thanh_id])->all();
                    $listQuanHuyen=\yii\helpers\ArrayHelper::map($quanHuyen,'id','ten');
                }
                ?>
                <?= $form->field($model, 'quan_huyen_id')->widget(\kartik\select2\Select2::className(),[
                    'data'=>$listQuanHuyen,
                    'options'=>[
                        'prompt'=>Yii::t('frontend','Lựa chọn Quận huyện'),
                        'onchange'=>'
                        $.get( "'.\yii\helpers\Url::toRoute('/site/danh-sach-xa-phuong').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'xa_phuong_id').'" ).html( data );
                            }
                        );
                    '
                    ],
                    'pluginOptions'=>['allowClear'=>true]
                ]) ?>
            </div>
            <div class="col-sm-4">
                <?php
                if(is_null($model->quan_huyen_id))
                {
                    $listXaPhuong=array();
                }else {
                    $phuongXa = \common\models\XaPhuong::find()->where(['quan_huyen_id'=>$model->quan_huyen_id])->all();
                    $listXaPhuong = \yii\helpers\ArrayHelper::map($phuongXa, 'id', 'ten');
                }
                ?>
                <?= $form->field($model, 'xa_phuong_id')->widget(\kartik\select2\Select2::className(),[
                    'data'=>$listXaPhuong,
                    'options'=>['prompt'=>Yii::t('frontend','Lựa chọn Xã phường')],
                    'pluginOptions'=>['allowClear'=>true],
                ]) ?>
            </div>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('backend', 'Lưu thông tin hồ sơ'), ['class' => 'btn btn-primary','name'=>'luuThongTin','value' => 'create_update']) ?>
            <?php
            if($model->isNewRecord){
                echo Html::submitButton(Yii::t('backend', 'Lưu thông tin & thêm lô rừng'), ['class' => 'btn btn-success','name'=>'luuThongTin','value' => 'create_themBKLS']);
            }
            ?>
            <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
