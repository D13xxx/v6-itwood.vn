<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/15/2019
 * Time: 2:23 PM
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">Tạo tài khoản</h4>
    </div>
    <div class="panel-body">
        <div class="col-sm-12">
            <?= Html::errorSummary($model)?>
            <?= $form->field($model, 'fullname')->label('Tên đầy đủ') ?>
            <?= $form->field($model, 'username')->label('Tài khoản đăng nhập') ?>
            <?= $form->field($model, 'email')->label('Địa chỉ email') ?>
            <?= $form->field($model, 'password')->passwordInput()->label('Mật khẩu') ?>
            <?= $form->field($model, 'retypePassword')->passwordInput()->label('Nhập lại mật khẩu') ?>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">Phân quyền tài khoản</h4>
                </div>
                <div class="panel-body">
                    <?php
                    $tinhThanh = \common\models\TinhThanh::find()->active()->all();
                    $listTinhThanh = \yii\helpers\ArrayHelper::map($tinhThanh,'id','ten');
                    ?>
                    <div class="col-sm-4">
                        <?= $form->field($modelUser, 'sys_tinh_thanh_id')->widget(\kartik\select2\Select2::className(),[
                            'data'=>$listTinhThanh,
                            'options'=>[
                                'multiple' => true,
                                'prompt'=>Yii::t('frontend','Lựa chọn tỉnh thành'),
                                'onchange'=>'
                        $.get( "/user/quan-ly/danh-sach-quan-huyen?id=",{tinhThanhID:$(this).val()})
                            .done(function( data ) {
                                $( "#'.Html::getInputId($modelUser, 'sys_quan_huyen_id').'" ).html( data );
                            }
                        );
                    '
                            ],
                            'pluginOptions'=>['allowClear'=>true]
                        ])->label('Tỉnh thành') ?>
                    </div>
                    <div class="col-sm-4">
                        <?php
                        if(is_null($modelUser->sys_tinh_thanh_id))
                        {
                            $listQuanHuyen=array();
                        }else {
                            $quanHuyen=\common\models\QuanHuyen::find()->where(['tinh_thanh_id'=>$modelUser->sys_tinh_thanh_id])->all();
                            $listQuanHuyen=\yii\helpers\ArrayHelper::map($quanHuyen,'id','ten');
                        }
                        ?>
                        <?= $form->field($modelUser, 'sys_quan_huyen_id')->widget(\kartik\select2\Select2::className(),[
                            'data'=>$listQuanHuyen,
                            'options'=>[
                                'multiple' => true,
                                'prompt'=>Yii::t('frontend','Lựa chọn Quận huyện'),
                                'onchange'=>'
                        $.get( "'.\yii\helpers\Url::toRoute('/user/quan-ly/danh-sach-xa-phuong?id=').'", { quanHuyenID: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($modelUser, 'sys_xa_phuong_id').'" ).html( data );
                            }
                        );
                    '
                            ],
                            'pluginOptions'=>['allowClear'=>true]
                        ])->label('Quận huyện') ?>
                    </div>
                    <div class="col-sm-4">
                        <?php
                        if(is_null($modelUser->sys_quan_huyen_id))
                        {
                            $listXaPhuong=array();
                        }else {
                            $phuongXa = \common\models\XaPhuong::find()->where(['quan_huyen_id'=>$modelUser->sys_quan_huyen_id])->all();
                            $listXaPhuong = \yii\helpers\ArrayHelper::map($phuongXa, 'id', 'ten');
                        }
                        ?>
                        <?= $form->field($modelUser, 'sys_xa_phuong_id')->widget(\kartik\select2\Select2::className(),[
                            'data'=>$listXaPhuong,
                            'options'=>['multiple' => true,'prompt'=>Yii::t('backend','Lựa chọn Xã phường')],
                            'pluginOptions'=>['allowClear'=>true],
                        ])->label('Xã phường') ?>
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
                                'options'=>['prompt'=>'Lựa chọn quyền hạn','class'=>'form-control'],
                                'pluginOptions'=>['allowClear'=>true]
                            ])?>
                        </div>
                        <div class="clearfix"></div>
                    </div>


                </div>
            </div>
        </div>

    </div>
    <div class="panel-footer">
        <?= Html::submitButton('Tạo tài khoản',['class'=>'btn btn-primary','name' => 'signup-button'])?>
    </div>

</div>
<?php ActiveForm::end(); ?>