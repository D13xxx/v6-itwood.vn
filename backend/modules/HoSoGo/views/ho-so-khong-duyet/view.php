<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/26/2019
 * Time: 4:56 PM
 */
use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = Yii::t('backend','Xem hồ sơ khai thác: ') .$model->ma;
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title"> <?= Html::encode($this->title) ?> </h4>
    </div>
    <div class="panel-body">
        <div class="col-sm-12">
            <?= DetailView::widget([
                'model'=>$model,
                'attributes'=>[
                    'ma',
                    [
                        'attribute'=>'ngay_lap',
                        'value'=>function($data){
                            return date("d/m/Y", strtotime($data->ngay_lap));
                        }
                    ],
                    [
                        'label'=>Yii::t('backend','Khối lượng lô gỗ'),
                        'value'=>function($data)
                        {
                            return \common\models\RegHoSoGo::TongKhoiLuongLoGo($data->id);
                        }
                    ],
                    [
                        'attribute'=>'reg_chu_the_id',
                        'value'=>function($data)
                        {
                            return $data->chuThe ? $data->chuThe->fullname : '';
                        }
                    ],
                ]
            ])?>
        </div>
        <div class="col-sm-12">
            <h4 class="panel-title"><?= Yii::t('backend','Thông tin khai thác')?></h4>
            <?= \yii\grid\GridView::widget([
                'dataProvider'=>$dataChiTiet,
                'columns'=>[
                    [
                        'label'=>'Mã lô rừng',
                        'value'=>function($data){
                            return $data->loRung ? $data->loRung->ma : '';
                        }
                    ],
                    [
                        'label'=>'Loài cây',
                        'value'=>function($data)
                        {
                            return \common\models\RegHoSoGoChiTiet::ThongTinLoaiCay($data->reg_ho_so_xin_khai_thac_id)->loaiCayTrong->ten;
                        }
                    ],
                    'cap_duong_kinh_trung_binh',
                    'chieu_dai',
                    'so_luong',
                    'khoi_luong'
                ]
            ])?>
        </div>
        <div class="col-sm-12">
            <h4 class="panel-title"><?= Yii::t('backend','Thông tin đăng ký khai thác')?></h4>
            <?= \yii\grid\GridView::widget([
                'dataProvider'=>$dataKhaiThac,
                'columns'=>[
                    [
                        'label'=>'Mã lô rừng',
                        'value'=>function($data){
                            return $data->loRung ? $data->loRung->ma : '';
                        }
                    ],
                    [
                        'label'=>'Loài cây',
                        'value'=>function($data){
                            return \common\models\RegHoSoGoChiTiet::ThongTinLoaiCay($data->reg_ho_so_xin_khai_thac_id)->loaiCayTrong->ten;
                        }
                    ],
                    [
                        'label'=>Yii::t('backend','Diện tích khai thác (m3)'),
                        'value'=>function($data){
                            return $data->bangKeLamSan ? $data->bangKeLamSan->dien_tich_khai_thac : '';
                        }
                    ],
                    [
                        'label'=>Yii::t('backend','Diện tích khai thác (m3)'),
                        'value'=>function($data){
                            return $data->bangKeLamSan ? $data->bangKeLamSan->dien_tich_khai_thac : '';
                        }
                    ],
                    [
                        'label'=>Yii::t('backend','Phương thức khai thác'),
                        'value'=>function($data){
                            return $data->bangKeLamSan ? $data->bangKeLamSan->phuongThucKhaiThac->ten : '';
                        }
                    ],
                    [
                        'label'=>Yii::t('backend','Số cây hiện tại'),
                        'value'=>function($data){
                            return $data->bangKeLamSan ? $data->bangKeLamSan->so_cay_hien_tai : '';
                        }
                    ],
                    [
                        'label'=>Yii::t('backend','D13 phổ biến'),
                        'value'=>function($data){
                            return $data->bangKeLamSan ? $data->bangKeLamSan->d13_cay_pho_bien : '';
                        }
                    ],
                    [
                        'label'=>Yii::t('backend','Sản lượng dự kiến (m3)'),
                        'value'=>function($data){
                            return $data->bangKeLamSan ? $data->bangKeLamSan->san_luong_du_kien : '';
                        }
                    ],
                ]
            ])?>
        </div>
    </div>
    <div class="panel-footer">

        <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
    </div>
</div>
<div class="clearfix"></div>
