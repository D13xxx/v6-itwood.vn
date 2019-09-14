<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model common\models\ChiTietHoSoController */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-ho-so-xin-khai-thac-bkls-form">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"><?= Yii::t('frontend','Thông tin chi tiết')?></h4>
        </div>
        <div class="panel-body">
            <div class="col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Thông tin đăng ký khai thác
                        </h4>
                    </div>
                    <div class="panel-body">
                        <?= DetailView::widget([
                            'model' => $modelHoSoDangKyKhaiThac,
                            'attributes' => [
                                'ma',
                                'dien_tich_khai_thac',
                                [
                                    'attribute'=>'ngay_bat_dau',
                                    'value'=>function($data)
                                    {
                                        return ($data->ngay_bat_dau!=''||$data->ngay_bat_dau!=null)? date("d/m/Y",strtotime($data->ngay_bat_dau)) : '';
                                    }
                                ],
                                [
                                    'attribute'=>'ngay_ket_thuc',
                                    'value'=>function($data)
                                    {
                                        return ($data->ngay_ket_thuc!=''||$data->ngay_ket_thuc!=null)? date("d/m/Y",strtotime($data->ngay_ket_thuc)) : '';
                                    }
                                ],
                                [
                                    'attribute'=>'trang_thai_id',
                                    'format'=>'html',
                                    'value'=>function($data){
                                        return \common\models\RegHoSoXinKhaiThac::TT_HOSO_LABEL()[$data->trang_thai_id];
                                    }
                                ],
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Lô rừng đăng ký khai thác
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-12">
                            <?php
                            if($modelHoSoDangKyKhaiThac->loai_hinh_chu_the_id==1){
                                $loRungs= \common\models\RegLoRung::find()->where([
                                    'and',
                                    ['trang_thai_id'=>\common\models\RegLoRung::TT_RUNGDUOCDUYET],
                                    ['chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')],
                                    ['quan_huyen_id'=>$modelHoSoDangKyKhaiThac->quan_huyen_id]
                                ])->all();
                                $listLoRung = \yii\helpers\ArrayHelper::map($loRungs,'id',function ($data){
                                    return $data->ma .' - Tiểu khu: '.$data->tieu_khu .' - Khoảnh: '.$data->khoanh .' - Lô: '.$data->lo;
                                });
                            } else {
                                $loRungs= \common\models\RegLoRung::find()->where([
                                    'and',
                                    ['trang_thai_id'=>\common\models\RegLoRung::TT_RUNGDUOCDUYET],
                                    ['chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')],
                                    ['xa_phuong_id'=>$modelHoSoDangKyKhaiThac->xa_phuong_id]
                                ])->all();
                                $listLoRung = \yii\helpers\ArrayHelper::map($loRungs,'id',function ($data){
                                    return $data->ma .' - Tiểu khu: '.$data->tieu_khu .' - Khoảnh: '.$data->khoanh .' - Lô: '.$data->lo;
                                });
                            }
                            ?>
                            <?= $form->field($model, 'reg_lo_rung_id')->widget(\kartik\select2\Select2::className(),[
                                'data'=>$listLoRung,
                                'options'=>['prompt'=>Yii::t('frontend','Lựa chọn lô rừng')],
                                'pluginOptions'=>['allowClear'=>true]
                            ])->label('Lô rừng khai thác') ?>
                        </div>

                        <div class="col-sm-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><?= Yii::t('frontend','Thông tin khai thác')?></h4>
                                </div>
                                <div class="panel-body">
                                    <div class="col-sm-6">
                                        <?= $form->field($model, 'dien_tich_khai_thac')->textInput(['readonly'=>true]) ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?php
                                        $phuongThucKT = \common\models\SysKieuKhaiThac::find()->all();
                                        $listPTKT = \yii\helpers\ArrayHelper::map($phuongThucKT,'id','ten');
                                        ?>
                                        <?= $form->field($model, 'phuong_thuc_khai_thac_id')->widget(\kartik\select2\Select2::className(),[
                                            'data'=>$listPTKT,
                                            'options'=>['prompt'=>Yii::t('frontend','Chọn phương thức khai thác'),'disabled'=>true],
                                            'pluginOptions'=>['allowClear'=>true],
                                        ]) ?>
                                    </div>

                                    <div class="col-sm-6">
                                        <?= $form->field($model, 'tuoi_rung_khai_thac')->textInput(['readonly'=>true]) ?>
                                    </div>

                                    <div class="col-sm-6">
                                        <?= $form->field($model, 'so_cay_hien_tai')->textInput(['readonly'=>true]) ?>
                                    </div>

                                    <div class="col-sm-6">
                                        <?= $form->field($model, 'd13_cay_pho_bien')->textInput(['maxlength' => true,'readonly'=>true]) ?>
                                    </div>

                                    <div class="col-sm-6">
                                        <?= $form->field($model, 'san_luong_du_kien')->textInput(['readonly'=>true]) ?>
                                    </div>

                                    <div class="col-sm-12">
                                        <?= $form->field($model, 'phuong_an_bao_ve_rung')->textInput(['maxlength' => true,'readonly'=>true])->label('Chứng chỉ rừng (Mã số CCR)') ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><?= Yii::t('frontend','Thông tin rừng trồng')?></h4>
                                </div>
                                <div class="panel-body">
                                    <div class="col-sm-12">
                                        <?php
                                        $loaiCay = \common\models\SysLoaiCay::find()->active()->all();
                                        $listLoaiCay= \yii\helpers\ArrayHelper::map($loaiCay,'id','ten');
                                        ?>
                                        <?= $form->field($model,'loai_cay_trong_id')->widget(\kartik\select2\Select2::className(),[
                                            'data'=>$listLoaiCay,
                                            'options'=>['prompt'=>Yii::t('frontend','Chọn loại cây trồng'),'disabled'=>true],
                                            'pluginOptions'=>['allowClear'=>true],
                                        ])?>

                                        <?php
                                        $kieuTrongRung = \common\models\SysKieuTrongRung::find()->active()->all();
                                        $listKieuTrong = \yii\helpers\ArrayHelper::map($kieuTrongRung,'id','ten');
                                        ?>
                                        <?= $form->field($model,'phuong_thuc_trong_id')->widget(\kartik\select2\Select2::className(),[
                                            'data'=>$listKieuTrong,
                                            'options'=>['prompt'=>Yii::t('frontend','Lựa chọn phương thức trồng rừng'),'disabled'=>true],
                                            'pluginOptions'=>['allowClear'=>true],
                                        ])?>
                                        <?= $form->field($model,'nam_trong')->textInput(['readonly'=>true])?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?php
                                        $loaiVonDauTu = \common\models\SysLoaiVonDauTu::find()->all();
                                        $listLoaiVonDauTu = \yii\helpers\ArrayHelper::map($loaiVonDauTu,'id','ten');
                                        ?>
                                        <?= $form->field($model,'loai_von_dau_tu_id')->widget(\kartik\select2\Select2::className(),[
                                            'data'=>$listLoaiVonDauTu,
                                            'options'=>['prompt'=>Yii::t('frontend','Lựa chọn loại vốn đầu tư'),'disabled'=>true],
                                            'pluginOptions'=>['allowClear'=>true],
                                        ])?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?php
                                        $danhSach = [
                                            'Nhà nước' =>Yii::t('frontend','Nhà nước'),
                                            'Tổ chức' => Yii::t('frontend','Tổ chức'),
                                            'Hộ gia đình' => Yii::t('frontend','Hộ gia đình')
                                        ];
                                        ?>
                                        <?= $form->field($model,'chu_so_huu')->widget(\kartik\select2\Select2::className(),[
                                            'data'=>$danhSach,
                                            'options'=>[
                                                'prompt'=>Yii::t('frontend','Loại chủ sở hữu rừng'),
                                                'disabled'=>true
                                            ],
                                            'pluginOptions'=>['allowClear'=>true],
                                        ])->label('Chủ sở hữu rừng');?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?= Yii::t('frontend','Trách nhiệm tuân thủ')?></h4>
                    </div>
                    <div class="panel-body">
                        <?php
                        //                        echo Yii::$app->session->get('reg_loai_chu_the_id');
                        $trachNhiemTuanThus = \common\models\SysTrachNhiemTuanThu::find()->where([
                            'and',
                            ['loai_hinh_chu_the_id'=>Yii::$app->session->get('reg_loai_chu_the_id')],
//                        ['loai_rung_id'=>1]
                            'loai_rung_id'=>1
                        ])->all();
                        //                    print_r($trachNhiemTuanThus);
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle">#</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle">Trách nhiệm tuân thủ</th>
                                <th colspan="2" style="text-align: center; vertical-align: middle">Có/Không</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle; width: 20%">Tệp đính kèm</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; width: 5%">Có</th>
                                <th style="text-align: center; width: 5%">Không</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            foreach ($trachNhiemTuanThus as $trachNhiemTuanThu){
                                echo '<tr>';
                                echo '<td style="text-align: center">';
                                echo $i;
                                echo '</td>';
                                echo '<td>';
                                echo $trachNhiemTuanThu->ten;
                                echo '</td>';
                                echo '<td style="text-align: center">';
                                echo Html::radio('giaTris['.$trachNhiemTuanThu->id.']','true',['value'=>'1']);
                                echo '</td>';
                                echo '<td style="text-align: center">';
                                echo Html::radio('giaTris['.$trachNhiemTuanThu->id.']','false',['value'=>0]);
                                echo '</td>';
                                echo '<td>';
                                echo Html::fileInput('file_dinh_kem['.$trachNhiemTuanThu->id.'][]',null,['multiple'=>true]);
                                echo '</td>';
                                echo '</tr>';
                                $i++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('frontend', 'Lưu thông tin'), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('frontend','Quay lại'),Yii::$app->request->referrer,['class'=>'btn btn-default'])?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$scriptChooseLoRung = <<< JS
    $("#reghosoxinkhaithacbkls-reg_lo_rung_id").on('change',function() {
        var giaTri = $("#reghosoxinkhaithacbkls-reg_lo_rung_id").val();
        if(giaTri!==null || giaTri!==''){
            $('#reghosoxinkhaithacbkls-dien_tich_khai_thac').attr('readonly',false);
            $('#reghosoxinkhaithacbkls-tuoi_rung_khai_thac').attr('readonly',false);
            $('#reghosoxinkhaithacbkls-d13_cay_pho_bien').attr('readonly',false);
            $('#reghosoxinkhaithacbkls-phuong_thuc_khai_thac_id').attr('disabled',false);
            $('#reghosoxinkhaithacbkls-so_cay_hien_tai').attr('readonly',false);
            $('#reghosoxinkhaithacbkls-san_luong_du_kien').attr('readonly',false);
            $('#reghosoxinkhaithacbkls-phuong_an_bao_ve_rung').attr('readonly',false);
            
            $('#reghosoxinkhaithacbkls-loai_cay_trong_id').attr("disabled", false);
            $('#reghosoxinkhaithacbkls-phuong_thuc_trong_id').attr('disabled',false);
            $('#reghosoxinkhaithacbkls-nam_trong').attr('readonly',false);
            $('#reghosoxinkhaithacbkls-loai_von_dau_tu_id').attr('disabled',false);
            $('#reghosoxinkhaithacbkls-chu_so_huu').attr('disabled',false);
        }
        if(giaTri==''||giaTri==null){
            $('#reghosoxinkhaithacbkls-dien_tich_khai_thac').attr('readonly',true);
            $('#reghosoxinkhaithacbkls-tuoi_rung_khai_thac').attr('readonly',true);
            $('#reghosoxinkhaithacbkls-d13_cay_pho_bien').attr('readonly',true);
            $('#reghosoxinkhaithacbkls-phuong_thuc_khai_thac_id').attr('disabled',true);
            $('#reghosoxinkhaithacbkls-so_cay_hien_tai').attr('readonly',true);
            $('#reghosoxinkhaithacbkls-san_luong_du_kien').attr('readonly',true);
            $('#reghosoxinkhaithacbkls-phuong_an_bao_ve_rung').attr('readonly',true);
            
            $('#reghosoxinkhaithacbkls-loai_cay_trong_id').attr("disabled", true);
            $('#reghosoxinkhaithacbkls-phuong_thuc_trong_id').attr('disabled',true);
            $('#reghosoxinkhaithacbkls-nam_trong').attr('readonly',true);
            $('#reghosoxinkhaithacbkls-loai_von_dau_tu_id').attr('disabled',true);
            $('#reghosoxinkhaithacbkls-chu_so_huu').attr('disabled',true);
        }
    });
JS;

$this->registerJs($scriptChooseLoRung);
?>