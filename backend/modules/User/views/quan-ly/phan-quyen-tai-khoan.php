<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/17/2019
 * Time: 11:41 AM
 */
use yii\helpers\Html;
?>
<?php $form = \yii\widgets\ActiveForm::begin(); ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">Phân quyền cho tài khoản</h4>
    </div>
    <div class="panel-body">
        <?= $form->field($model,'fullname')->textInput(['readonly'=>true])->label('Tên đầy đủ')?>
        <?= $form->field($model,'username')->textInput(['readonly'=>true])->label('Tên đăng nhập')?>

        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">Danh sách quyền hạn</h4>
            </div>
            <div class="panel-body">
                <?php
                $tinhThanh = \common\models\TinhThanh::find()->active()->all();
                $listTinhThanh = \yii\helpers\ArrayHelper::map($tinhThanh,'id','ten');
                ?>
                <div class="col-sm-4">
                    <?= $form->field($model, 'sys_tinh_thanh_id')->widget(\kartik\select2\Select2::className(),[
                        'data'=>$listTinhThanh,
                        'options'=>[
                            'prompt'=>Yii::t('frontend','Lựa chọn tỉnh thành'),
                            'onchange'=>'
                        $.get( "'.\yii\helpers\Url::toRoute('/user/quan-ly/danh-sach-quan-huyen').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'sys_quan_huyen_id').'" ).html( data );
                            }
                        );
                    '
                        ],
                        'pluginOptions'=>['allowClear'=>true]
                    ]) ?>
                </div>
                <div class="col-sm-4">
                    <?php
                    if(is_null($model->sys_tinh_thanh_id))
                    {
                        $listQuanHuyen=array();
                    }else {
                        $quanHuyen=\common\models\QuanHuyen::find()->where(['tinh_thanh_id'=>$model->sys_tinh_thanh_id])->all();
                        $listQuanHuyen=\yii\helpers\ArrayHelper::map($quanHuyen,'id','ten');
                    }
                    ?>
                    <?= $form->field($model, 'sys_quan_huyen_id')->widget(\kartik\select2\Select2::className(),[
                        'data'=>$listQuanHuyen,
                        'options'=>[
                            'prompt'=>Yii::t('frontend','Lựa chọn Quận huyện'),
                            'onchange'=>'
                        $.get( "'.\yii\helpers\Url::toRoute('/user/quan-ly/danh-sach-xa-phuong').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'sys_xa_phuong_id').'" ).html( data );
                            }
                        );
                    '
                        ],
                        'pluginOptions'=>['allowClear'=>true]
                    ]) ?>
                </div>
                <div class="col-sm-4">
                    <?php
                    if(is_null($model->sys_quan_huyen_id))
                    {
                        $listXaPhuong=array();
                    }else {
                        $phuongXa = \common\models\XaPhuong::find()->where(['quan_huyen_id'=>$model->sys_quan_huyen_id])->all();
                        $listXaPhuong = \yii\helpers\ArrayHelper::map($phuongXa, 'id', 'ten');
                    }
                    ?>
                    <?= $form->field($model, 'sys_xa_phuong_id')->widget(\kartik\select2\Select2::className(),[
                        'data'=>$listXaPhuong,
                        'options'=>['prompt'=>Yii::t('backend','Lựa chọn Xã phường')],
                        'pluginOptions'=>['allowClear'=>true],
                    ]) ?>
                </div>

                <?php
                $quyenHan = \backend\models\AuthItem::find()->where(['and',['<>','name','SupperAdmin'],['<>','LEFT(name,1)','/']])->all();
                $listQuyenHan = \yii\helpers\ArrayHelper::map($quyenHan,'name','description');
                ?>
                <div class="col-sm-12">
                    <div class="control-group">
                        <label class="control-label">Lựa chọn quyền hạn</label>
                        <?= \kartik\select2\Select2::widget([
                            'name'=>'quyen_han',
                            'data'=>$listQuyenHan,
                            'options'=>['prmopt'=>'Lựa chọn quyền hạn','class'=>'form-control'],
                            'pluginOptions'=>['allowClear'=>true]
                        ])?>
                    </div>
                    <div class="clearfix"></div>
                </div>


            </div>
        </div>

    </div>
    <div class="panel-footer">
        <?= \yii\helpers\Html::submitButton('Lưu thông tin',['class'=>'btn btn-primary'])?>
    </div>
</div>
<?php \yii\widgets\ActiveForm::end() ?>
<div class="clearfix"></div>