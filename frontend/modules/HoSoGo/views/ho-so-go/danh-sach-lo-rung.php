<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/25/2019
 * Time: 11:26 AM
 */
use yii\helpers\Html;
use yii\grid\GridView;

?>
<div class="danh-sach-lo-rung">
    <?php $form = \yii\widgets\ActiveForm::begin(['id'=>'danhSachLoRung']); ?>
    <div class="panel panel-primary">
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider'=>$dataProvider,
                'summary'=>'',
                'columns'=>[
                    [
                        'attribute'=>'reg_lo_rung_id',
                        'headerOptions'=>['style'=>'text-align: center; vertical-align: middle'],
                        'value'=>function($data){
                            return $data->loRung ? $data->loRung->ma : '';
                        }
                    ],
                    [
                        'attribute'=>'dien_tich_khai_thac',
                        'headerOptions'=>['style'=>'text-align: center; vertical-align: middle'],
                        'contentOptions'=>['style'=>'text-align: center'],
                    ],
//        [
//            'attribute'=>'phuong_thuc_khai_thac_id',
//            'value'=>function($data){
//                return $data->phuongThucKhaiThac ? $data->phuongThucKhaiThac->ten : '';
//            }
//        ],
                    [
                        'attribute'=>'tuoi_rung_khai_thac',
                        'headerOptions'=>['style'=>'text-align: center; vertical-align: middle'],
                        'contentOptions'=>['style'=>'text-align: center'],
                    ],
                    [
                        'attribute'=>'san_luong_du_kien',
                        'format'=>['decimal',3],
                        'headerOptions'=>['style'=>'text-align: center; vertical-align: middle'],
                        'contentOptions'=>['style'=>'text-align: right'],
                    ],
                    [
                        'attribute'=>'khoi_luong_da_dung',
                        'headerOptions'=>['style'=>'text-align: center; vertical-align: middle'],
                        'format'=>['decimal',3],
                        'contentOptions'=>['style'=>'text-align: right'],
                    ],
                    [
                        'label'=>'Đường kính TB (cm)',
                        'headerOptions'=>['style'=>'text-align: center; vertical-align: middle'],
                        'format'=>'raw',
                        'value'=>function($data)
                        {
                            return Html::textInput('duong_kinh_trung_binh_'.$data->id,null,['class'=>'form-control']);
                        }
                    ],
                    [
                        'label'=>'Chiều dài (m)',
                        'headerOptions'=>['style'=>'text-align: center; vertical-align: middle'],
                        'format'=>'raw',
                        'value'=>function($data)
                        {
                            return Html::textInput('chieu_dai_'.$data->id,null,['class'=>'form-control']);
                        }
                    ],
                    [
                        'label'=>'Số lượng (khúc)',
                        'headerOptions'=>['style'=>'text-align: center; vertical-align: middle'],
                        'format'=>'raw',
                        'value'=>function($data)
                        {
                            return Html::textInput('so_khuc_'.$data->id,null,['class'=>'form-control']);
                        }
                    ],
                    [
                        'label'=>'Khối lượng (m3)',
                        'headerOptions'=>['style'=>'text-align: center; vertical-align: middle'],
                        'format'=>'raw',
                        'value'=>function($data)
                        {
                            return Html::textInput('khoi_luong_'.$data->id,null,['class'=>'form-control']);
                        }
                    ],
                    ['class'=>'yii\grid\CheckboxColumn']
                ]
            ]);?>
        </div>
        <div class="panel-footer">
            <div class="col-sm-4">
                <?= Html::submitButton(Yii::t('frontend', 'Lưu thông tin'), ['class' => 'btn btn-primary btn-block','name'=>'luuThongTin','value' => 'create']) ?>
            </div>
            <div class="col-sm-4">
                <?= Html::submitButton(Yii::t('frontend', 'Lưu và thêm mới'), ['class' => 'btn btn-success btn-block','name'=>'luuThongTin','value' => 'create_new']) ?>
            </div>
            <div class="col-sm-4">
                <?= Html::a(Yii::t('frontend','Đóng cửa sổ'),['update','id'=>$idHoSoGo],['class'=>'btn btn-default btn-block'])?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php \yii\widgets\ActiveForm::end();?>
</div>

