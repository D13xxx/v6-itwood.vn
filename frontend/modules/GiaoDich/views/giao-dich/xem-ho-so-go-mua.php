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
                <strong>THÔNG TIN LÔ GỖ</strong> <br>
                <?= DetailView::widget([
                    'model'=>$model,
                    'attributes'=>[
                        'ma',
                        [
                            'label'=>'Tổng khối lượng lô gỗ',
                            'value'=>function($data){
                                return \common\models\RegHoSoGo::TongKhoiLuongLoGo($data->id);
                            }
                        ],
                        [
                            'attribute'=>'ngay_lap',
                            'value'=>function($data){
                                return date("d/m/Y",strtotime($data->ngay_lap));
                            }
                        ],
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
                        'cap_duong_kinh_trung_binh',
                        'chieu_dai',
                        'so_luong',
                        'khoi_luong',
                    ]
                ])?>
            </div>

        </div>
        <div class="panel-footer">
            <?= Html::a(Yii::t('backend', 'Xác nhận mua'), ['xac-nhan-mua-lo-go','id'=>$model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('backend', 'Không mua'), ['khong-mua-lo-go','id'=>$model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a(Yii::t('backend','Quay lại'),['mua-ho-so-go'],['class'=>'btn btn-default'])?>
        </div>
    </div>

</div>
