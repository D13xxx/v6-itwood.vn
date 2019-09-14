<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/27/2019
 * Time: 2:45 PM
 */
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = Yii::t('frontend','Hồ sơ lô rừng: ').$model->ma;

?>
<div class="xem-ho-so-dang-ky">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"> Xem chi tiết: <?= Html::encode($this->title) ?> </h4>
        </div>
        <div class="panel-body">
            <div class="col-sm-6">
                <strong>THÔNG TIN NGƯỜI BÁN</strong>
                <?php
                if($modelUser->loai_chu_the_id==1){
                    echo DetailView::widget([
                        'model'=>$modelChuTheCu,
                        'attributes'=>[
                            'ma',
                            'ten_to_chuc',
                            'ma_so_thue',
                            'dia_chi_tru_so'
                        ]
                    ]);
                } else {
                    echo DetailView::widget([
                        'model'=>$modelChuTheCu,
                        'attributes'=>[
                            'ma',
                            'ten',
                            'so_cmtnd',
                            'noi_thuong_tru'
                        ]
                    ]);
                }
                ?>
            </div>
            <div class="col-sm-6">
                <strong>THÔNG TIN KHAI THÁC</strong> <br>
                <?= DetailView::widget([
                    'model'=>$model,
                    'attributes'=>[
                        'ma',
                        'dien_tich_khai_thac',
                        [
                            'attribute'=>'ngay_bat_dau',
                            'value'=>function($data){
                                return date("d/m/Y",strtotime($data->ngay_bat_dau));
                            }
                        ],
                        [
                            'attribute'=>'ngay_ket_thuc',
                            'value'=>function($data){
                                return date("d/m/Y",strtotime($data->ngay_ket_thuc));
                            }
                        ]
                    ]
                ])?>
            </div>
            <div class="col-sm-12">
                <strong>BẢNG KÊ CHI TIẾT</strong>
                <?= GridView::widget([
                    'dataProvider'=>$dataProvider,
                    'summary'=>'',
                    'columns'=>[
                        [
                            'label'=>Yii::t('frontend','Mã lô rừng'),
                            'value'=>function($data){
                                return $data->loRung ? $data->loRung->ma : '';
                            }
                        ],
                        'dien_tich_khai_thac',
                        [
                            'attribute'=>'phuong_thuc_khai_thac_id',
                            'value'=>function($data){
                                return $data->phuongThucKhaiThac ? $data->phuongThucKhaiThac->ten : '';
                            }
                        ],
                        'tuoi_rung_khai_thac',
                        'so_cay_hien_tai',
                        'd13_cay_pho_bien',
                        'san_luong_du_kien',
                        'phuong_an_bao_ve_rung',
                    ]
                ])?>
            </div>

        </div>
        <div class="panel-footer">
            <?= Html::a(Yii::t('backend', 'Xác nhận mua'), ['mua-lo-rung','id'=>$model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('backend', 'Không mua'), ['khong-mua-rung','id'=>$model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a(Yii::t('backend','Quay lại'),['mua-rung'],['class'=>'btn btn-default'])?>
        </div>
    </div>

</div>
