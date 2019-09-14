<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoGo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-ho-so-go-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="panel-body">

            <?= $form->field($model, 'ma')->textInput(['maxlength' => true,'readonly'=>true]) ?>

            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title"><?= Yii::t('frontend','Thông tin lô gỗ khai thác')?>
                        <span class="pull-right">
                            <?= Html::a(Yii::t('frontend','Thêm lô gỗ'),[
                                '/ho-so-go/ho-so-go/them-lo-go','idHoSoGo'=>$model->id
                            ],[
                                'class'=>'btn btn-xs btn-primary'
                            ])?>
                        </span>
                    </h4>

                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th rowspan="2">#</th>
                            <th rowspan="2">Mã lô rừng</th>
                            <th colspan="2">Tên gỗ/Loài cây</th>
                            <th colspan="2">Quy cách gỗ</th>
                            <th rowspan="2">Số lương (khúc)</th>
                            <th rowspan="2">Khối lượng (m3)</th>
                            <th rowspan="2"></th>
                        </tr>
                        <tr>
                            <th>Tên phổ thông</th>
                            <th>Tên khoa học</th>
                            <th>Cấp đường kính trung bình (cm)</th>
                            <th>Dài (m)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(isset($hoSoGoChiTiet) && $hoSoGoChiTiet!=null){
                            $i=1;
                            foreach ($hoSoGoChiTiet as $value)
                            {
                                $loRung = \common\models\RegLoRung::find()->where(['id'=>$value->reg_lo_rung_id])->one();
                                $bklsXinKhaiThac = \common\models\RegHoSoXinKhaiThacBkls::find()->where(['id'=>$value->reg_ho_so_xin_khai_thac_id])->one();
                                $loaiCay = \common\models\SysLoaiCay::find()->where(['id'=>$bklsXinKhaiThac->loai_cay_trong_id])->one();
                                ?>
                                <tr>
                                    <td><?= $i;?></td>
                                    <td> <?= $loRung->ma?></td>
                                    <td><?= $loaiCay->ten?></td>
                                    <td><?= $loaiCay->ten_khoa_hoc?></td>
                                    <td><?= $value->cap_duong_kinh_trung_binh?></td>
                                    <td><?= $value->chieu_dai?></td>
                                    <td><?= $value->so_luong?></td>
                                    <td><?= $value->khoi_luong?></td>
                                    <td>
                                        <?php
                                        $urlDel = \yii\helpers\Url::to(['/ho-so-go/ho-so-go/xoa-thong-tin','id'=>$value->id]);
                                        echo Html::a('<span class="glyphicon glyphicon-trash"></span>',$urlDel,['title'=>Yii::t('frontend','Xóa thông tin')]);
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            $i++;
                            }
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="panel-footer">
            <?= Html::a(Yii::t('backend', 'Đề nghị duyệt'),['de-nghi-duyet','idHoSoGo'=>$model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
