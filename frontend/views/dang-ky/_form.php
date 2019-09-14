<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/21/2019
 * Time: 11:11 PM
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php $form = ActiveForm::begin(['id'=>'nhapLieu','options'=>['name'=>'nhapLieu','enctype'=>'multipart/form-data']]); ?>
<div class="panel panel-success">
    <div class="panel-heading">
        <h4 class="panel-title">Thông tin chủ thể</h4>
    </div>
    <div class="panel-body">
        <?php
        if(isset($modelToChuc)){
            echo $form->field($modelToChuc,'ten_to_chuc')->textInput();
            echo $form->field($modelToChuc,'ten_thuong_mai')->textInput();
            echo $form->field($modelToChuc,'ten_tieng_nuoc_ngoai')->textInput();
            echo '<div class="row">';
            echo '<div class="col-sm-4">';
            echo $form->field($modelToChuc,'giay_dang_ky_kd')->textInput();
            echo '</div>';
            echo '<div class="col-sm-4">';
            echo $form->field($modelToChuc,'ma_so_thue')->textInput();
            echo '</div>';
            echo '<div class="col-sm-4">';
            echo $form->field($modelToChuc,'so_dien_thoai')->textInput();
            echo '</div>';
            echo '</div>';
            echo '<div class="row">';
            echo '<div class="col-sm-6">';
            echo $form->field($modelToChuc,'dia_chi_tru_so')->textInput();
            echo '</div>';

            echo '<div class="col-sm-6">';
            echo $form->field($modelToChuc,'email')->textInput();
            echo '</div>';
            echo '</div>';
            echo '<div class="row">';
            echo '<div class="col-sm-4">';
            $tinhThanh = \common\models\TinhThanh::find()->active()->all();
            $listTinhThanh = \yii\helpers\ArrayHelper::map($tinhThanh,'id','ten');
            echo $form->field($modelToChuc,'tinh_thanh_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>$listTinhThanh,
                'options'=>[
                    'prompt'=>Yii::t('frontend','Lựa chọn tỉnh thành'),
                    'onchange'=>'
                        $.get( "'.\yii\helpers\Url::toRoute('/dang-ky/danh-sach-quan-huyen').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($modelToChuc, 'quan_huyen_id').'" ).html( data );
                            }
                        );
                    '
                ],
                'pluginOptions'=>['allowClear'=>true]
            ]);
            echo '</div>';
            echo '<div class="col-sm-4">';
            if(is_null($modelToChuc->tinh_thanh_id))
            {
                $listQuanHuyen=array();
            }else {
                $quanHuyen=\common\models\QuanHuyen::find()->where(['tinh_thanh_id'=>$modelToChuc->tinh_thanh_id])->all();
                $listQuanHuyen=\yii\helpers\ArrayHelper::map($quanHuyen,'id','ten');
            }
            echo $form->field($modelToChuc,'quan_huyen_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>$listQuanHuyen,
                'options'=>[
                    'prompt'=>Yii::t('frontend','Lựa chọn Quận huyện'),
                    'onchange'=>'
                        $.get( "'.\yii\helpers\Url::toRoute('/dang-ky/danh-sach-xa-phuong').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($modelToChuc, 'xa_phuong_id').'" ).html( data );
                            }
                        );
                    '
                ],
                'pluginOptions'=>['allowClear'=>true]
            ]);
            echo '</div>';
            echo '<div class="col-sm-4">';
            if(is_null($modelToChuc->quan_huyen_id))
            {
                $listXaPhuong=array();
            }else {
                $phuongXa = \common\models\XaPhuong::find()->where(['quan_huyen_id'=>$modelToChuc->quan_huyen_id])->all();
                $listXaPhuong = \yii\helpers\ArrayHelper::map($phuongXa, 'id', 'ten');
            }
            echo $form->field($modelToChuc,'xa_phuong_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>$listXaPhuong,
                'options'=>['prompt'=>Yii::t('frontend','Lựa chọn Xã phường')],
                'pluginOptions'=>['allowClear'=>true],
            ]);
            echo '</div>';
            echo '</div>';
            echo $form->field($modelToChuc,'loai_hinh_hoat_dong_id_array')->checkboxList(\common\models\RegChuTheToChuc::LOAI_HINH_HOAT_DONG_ARRAY,['separator' => '<br>',]);
            echo $form->field($modelToChuc,'nguoi_dai_dien')->textInput();
            echo '<div class="row">';
            echo '<div class="col-sm-4">';
            echo $form->field($modelToChuc,'so_cmtnd')->textInput();
            echo '</div>';
            echo '<div class="col-sm-4">';
            echo $form->field($modelToChuc,'ngay_cap')->widget(\kartik\widgets\DatePicker::className(),[
                'options' => ['placeholder' => 'Ngày / Tháng / Năm'],
                'language' => 'vi',
                'pluginOptions' => [
                    'format' => 'dd/mm/yyyy',
//                    'startDate' => '01-Mar-1900 12:00 AM',
//                    'todayHighlight' => true
                ]
            ]);
            echo '</div>';
            echo '<div class="col-sm-4">';
            echo $form->field($modelToChuc,'noi_cap')->textInput();
            echo '</div>';
            echo '</div>';

            echo $form->field($modelToChuc,'file_dinh_kem[]')->widget(\kartik\widgets\FileInput::className(),[
                'options'=>['accept'=>['*'],'multiple' => true],
                'pluginOptions'=>[
                    'showUpload' => false,
                    'browseLabel'=>Yii::t('frontend','Chọn tệp đính kèm'),
                    'removeLabel'=>Yii::t('frontend','Hủy bỏ'),
                    'allowedFileExtensions'=>['jpg','jpeg','bmp','png','gif','pdf'],
                ]
            ]);
        }
        if(isset($modelHoGiaDinh)){
            echo $form->field($modelHoGiaDinh,'ten')->textInput();
            echo $form->field($modelHoGiaDinh,'ma_so_thue')->textInput();
            echo '<div class="row">';
            echo '<div class="col-sm-4">';
            echo $form->field($modelHoGiaDinh,'so_cmtnd')->textInput();
            echo '</div>';
            echo '<div class="col-sm-4">';
            echo $form->field($modelHoGiaDinh,'ngay_cap')->widget(\kartik\widgets\DatePicker::className(),[
                'options' => ['placeholder' => 'Ngày / Tháng / Năm'],
                'language' => 'vi',
                'pluginOptions' => [
                    'format' => 'dd/mm/yyyy',
//                    'startDate' => '01-Mar-1900 12:00 AM',
//                    'todayHighlight' => true
                ]
            ]);
            echo '</div>';
            echo '<div class="col-sm-4">';
            echo $form->field($modelHoGiaDinh,'noi_cap')->textInput();
            echo '</div>';
            echo '</div>';

            echo $form->field($modelHoGiaDinh,'noi_thuong_tru')->textInput();
            echo '<div class="row">';
            echo '<div class="col-sm-4">';
            $tinhThanh = \common\models\TinhThanh::find()->active()->all();
            $listTinhThanh = \yii\helpers\ArrayHelper::map($tinhThanh,'id','ten');
            echo $form->field($modelHoGiaDinh,'tinh_thanh_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>$listTinhThanh,
                'options'=>[
                    'prompt'=>Yii::t('frontend','Lựa chọn tỉnh thành'),
                    'onchange'=>'
                        $.get( "'.\yii\helpers\Url::toRoute('/dang-ky/danh-sach-quan-huyen').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($modelHoGiaDinh, 'quan_huyen_id').'" ).html( data );
                            }
                        );
                    '
                ],
                'pluginOptions'=>['allowClear'=>true]
            ]);
            echo '</div>';
            echo '<div class="col-sm-4">';
            if(is_null($modelHoGiaDinh->tinh_thanh_id))
            {
                $listQuanHuyen=array();
            }else {
                $quanHuyen=\common\models\QuanHuyen::find()->where(['tinh_thanh_id'=>$model->tinh_thanh_id])->all();
                $listQuanHuyen=\yii\helpers\ArrayHelper::map($quanHuyen,'id','ten');
            }
            echo $form->field($modelHoGiaDinh,'quan_huyen_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>$listQuanHuyen,
                'options'=>[
                    'prompt'=>Yii::t('frontend','Lựa chọn Quận huyện'),
                    'onchange'=>'
                        $.get( "'.\yii\helpers\Url::toRoute('/dang-ky/danh-sach-xa-phuong').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($modelHoGiaDinh, 'xa_phuong_id').'" ).html( data );
                            }
                        );
                    '
                ],
                'pluginOptions'=>['allowClear'=>true]
            ]);
            echo '</div>';
            echo '<div class="col-sm-4">';
            if(is_null($modelHoGiaDinh->quan_huyen_id))
            {
                $listXaPhuong=array();
            }else {
                $phuongXa = \common\models\XaPhuong::find()->where(['quan_huyen_id'=>$modelHoGiaDinh->quan_huyen_id])->all();
                $listXaPhuong = \yii\helpers\ArrayHelper::map($phuongXa, 'id', 'ten');
            }
            echo $form->field($modelHoGiaDinh,'xa_phuong_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>$listXaPhuong,
                'options'=>['prompt'=>Yii::t('frontend','Lựa chọn Xã phường')],
                'pluginOptions'=>['allowClear'=>true],
            ]);
            echo '</div>';
            echo '</div>';
            echo $form->field($modelHoGiaDinh,'loai_hinh_hoat_dong_id_array')->checkboxList(\common\models\RegChuTheHoGiaDinh::LOAI_HINH_HOAT_DONG_ARRAY,['separator' => '<br>',]);
            echo '<div class="row">';
            echo '<div class="col-sm-6">';
            echo $form->field($modelHoGiaDinh,'email')->textInput();
            echo '</div>';
            echo '<div class="col-sm-6">';
            echo $form->field($modelHoGiaDinh,'so_dien_thoai')->textInput();
            echo '</div>';
            echo '</div>';
            echo $form->field($modelHoGiaDinh,'file_dinh_kem[]')->widget(\kartik\widgets\FileInput::className(),[
                'options'=>['accept'=>['*'],'multiple' => true],
                'pluginOptions'=>[
                    'showUpload' => false,
                    'browseLabel'=>Yii::t('frontend','Chọn tệp đính kèm'),
                    'removeLabel'=>Yii::t('frontend','Hủy bỏ'),
                    'allowedFileExtensions'=>['jpg','jpeg','bmp','png','gif','pdf'],
                ]
            ]);
        }
        ?>
    </div>
    <div class="panel-footer">
        <?= \yii\helpers\Html::submitButton(Yii::t('frontend','Đăng ký'),['class'=>'btn btn-primary btn-block'])?>
    </div>
</div>
<?php ActiveForm::end() ?>