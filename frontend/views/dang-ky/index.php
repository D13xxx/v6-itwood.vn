<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/21/2019
 * Time: 4:47 PM
 */
use yii\widgets\ActiveForm;
//use yii\widgets\Pjax;
?>
<div class="dang-ky-index">

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="panel-title">Đăng ký chủ thể</h4>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'loai_chu_the')->dropDownList(
                [
                    1 =>Yii::t('backend','Chủ thể là tổ chức - doanh nghiệp'),
                    2 => Yii::t('backend','Chủ thể là Hộ gia đình')
                ],
                [
                    'prompt'=>Yii::t('frontend','Thuộc loại chủ thể ...'),
                    'id'=>'HGDTC',
                ]
            )->label(Yii::t('backend','Loại chủ thể')) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
    <div id="formNhapLieu"></div>
</div>
<div class="clearfix"></div>
<?php
$script = <<< JS

    $("#HGDTC").change(function() {
        var loaiChuThe1= $('#HGDTC').val();
        if(loaiChuThe1==1){
            $.ajax({
                type: "POST",
                url: '/dang-ky/reg-to-chuc',
                success: function(result) {
                    $("#formNhapLieu").html(result);
                }
            });
        }
        else if(loaiChuThe1==2){
            $.ajax({
                type: "POST",
                url: '/dang-ky/reg-ho-gia-dinh',
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