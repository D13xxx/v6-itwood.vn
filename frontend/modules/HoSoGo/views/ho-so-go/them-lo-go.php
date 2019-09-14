<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/25/2019
 * Time: 10:31 AM
 */
//use yii\widgets\ActiveForm;
?>
<div class="them-lo-go">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"><?= Yii::t('frontend','Thêm lô gỗ khai thác')?></h4>
        </div>
        <div class="panel-body">
            <div class="col-sm-12">
                <?= \kartik\select2\Select2::widget([
                    'data'=>$listHoSoDangKyKhaiThac,
                    'name'=>'idHoSoXinKhaiThac',
                    'options'=>['prompt'=>Yii::t('frontend','Lựa chọn hồ sơ đăng ký khai thác'),'id'=>'danhSachLoRungThuocHoSo',],
                    'pluginOptions'=>['allowClear'=>true],
                ])?>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-sm-12">
                <div id="formNhapLieu"></div>
            </div>

        </div>

    </div>
</div>

<?php
$script = <<< JS
$('#danhSachLoRungThuocHoSo').change(function() {
    var idHoSoXinKhaiThac = $('#danhSachLoRungThuocHoSo').val();
    // alert(idHoSoXinKhaiThac);
    $.ajax({
        // type: "POST",
        url: '/ho-so-go/ho-so-go/danh-sach-lo-rung?idHoSoXinKhaiThac='+idHoSoXinKhaiThac+'&idHoSoGo='+$idHoSoGo,
        success: function(result) {
            $("#formNhapLieu").html(result);
        }
    });
});
JS;
$this->registerJS($script);
?>