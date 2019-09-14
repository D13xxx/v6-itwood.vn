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
use yii\widgets\ActiveForm;

$this->title = Yii::t('frontend','Bán lô rừng: ').$model->ma;

?>
<div class="ban-lo-rung">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"> Xem chi tiết: <?= Html::encode($this->title) ?> </h4>
        </div>
        <div class="panel-body">
            <strong>I. Thông tin khai thác</strong> <br>
            <?= DetailView::widget([
                'model'=>$model,
                'attributes'=>[
                    'ma',
                    [
                        'label'=>'Khối lượng lô gỗ',
                        'value'=>function($data){
                            return \common\models\RegHoSoGo::TongKhoiLuongLoGo($data->id);
                        }
                    ],
                    [
                        'attribute'=>'ngay_lap',
                        'value'=>function($data){
                            return date("d/m/Y",strtotime($data->ngay_lap));
                        }
                    ]
                ]
            ])?>
            <br>
            <strong>II.Bảng kê chi tiết</strong>
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
            <br>
            <strong>THÔNG TIN NGƯỜI MUA</strong><br>
            <div class="form-group">
                <label class="control-label">Loại chủ thể</label>
                <?= Html::dropDownList('loai_chu_the_id',null,
                    [
                        1 =>Yii::t('backend','Chủ thể là tổ chức - doanh nghiệp'),
                        2 => Yii::t('backend','Chủ thể là Hộ gia đình')
                    ],
                    [
                        'prompt'=>Yii::t('frontend','Thuộc loại chủ thể ...'),
                        'id'=>'HGDTC',
                        'class'=>'form-control'
                    ])?>
            </div>

            <div id="formNhapLieu"></div>
        </div>
        <div class="panel-footer">
            <?= Html::a(Yii::t('backend','Quay lại'),['ban-rung'],['class'=>'btn btn-default'])?>
        </div>
    </div>
</div>
<?php
$script = <<< JS

    $("#HGDTC").change(function() {
        var loaiChuThe1= $('#HGDTC').val();
        if(loaiChuThe1>0){
            $.ajax({
                type: "POST",
                url: '/giao-dich/giao-dich/giao-dich-lo-go?idLoaiChuThe='+loaiChuThe1+'&idHoSo='+$model->id,
                success: function(result) {
                    $("#formNhapLieu").html(result);
                }
            });
        }
        else {
            $('#HGDTC').val('');
            $("#formNhapLieu").html('');
        }
        
    })
    
JS;
$this->registerJs($script,\yii\web\View::POS_READY);
?>