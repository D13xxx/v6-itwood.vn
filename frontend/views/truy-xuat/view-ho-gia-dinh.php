<?php
use Da\QrCode\QrCode;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web');?>/css/print.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web');?>/css/styles.css">
    <!---->
</head>
<style>
    @media print {
        a[href]:after {
            content: none !important;
        }
    }
</style>
<body>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div id="printArea" style="margin-bottom: 100px" >
                <div style="font-weight: bold; text-align: center">
                    CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                    Độc lập - Tự do - Hạnh phúc<br>
                </div>
                <hr>
                <br>
                <h3 style="text-align: center;font-weight: bold;font-family: 'Times New Roman'">HỒ SƠ CHỦ THỂ</h3>
                <div style="text-align: center;font-weight: bold;font-family: 'Times New Roman'">
                    (Đối với: Hộ gia đình)
                </div>
                <br>
                <br>
                <table class="table-bordered" style="width: 100%">
                    <tr>
                        <table class="gridPrintTableNoBoder" style="width: 100%">
                            <tr>
                                <td style="padding-left: 50px">
                                    <?php
                                    $linhVucHoatDongChinh='';
                                    $linhVucHoatDongs=explode(';',$model->loai_hinh_hoat_dong_id);
                                    foreach ($linhVucHoatDongs as $linhVucHoatDong){
                                        $modelTam = \common\models\SysLoaiHinhHoatDong::find()->where(['id'=>$linhVucHoatDong])->one();
                                        $linhVucHoatDongChinh.=$modelTam->ten.'; ';
                                    }
                                    echo '1) Mã chủ thể: ' . $model->ma .'&nbsp;&nbsp;&nbsp; Ngày cấp: '.date("d/m/Y",strtotime($model->ngay_duyet)).'&nbsp;&nbsp;&nbsp; Nơi cấp: <br><br>';
                                    echo '2) Tên chủ thể: ' . $model->ten .'<br><br>';
                                    echo '3) Số CMTND: ' .$model->so_cmtnd.'&nbsp;Ngày cấp '.date("d/m/Y",strtotime($model->ngay_cap)).' Nơi Cấp '.$model->noi_cap.'<br><br>';
                                    echo '4) Mã số thuế: <br><br>';
                                    echo '5) Địa chỉ thường trú: ' .$model->noi_thuong_tru.'<br><br>';
                                    echo '6) Lĩnh vực hoạt động SXKD: ' .$linhVucHoatDongChinh.'<br><br>';
                                    echo '7) Liên hệ: Email ' .$model->email.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Điện thoại '.$model->so_dien_thoai.'<br><br>';
                                    ?>
                                </td>

                            </tr>
                        </table>
                    </tr>

                    <tr>
                        <br>
                        <table class="table-borderd" style="width: 100%">
                            <tr>
                                <td style="width: 40%; text-align: center">
                                    <?php
                                    if($model->trang_thai_id==1){

                                        echo '....,Ngày '.date("d",strtotime($model->ngay_duyet)) .' tháng '. date("m",strtotime($model->ngay_duyet)) . ' năm '.date("Y",strtotime($model->ngay_duyet)).'<br>';
                                        echo 'CƠ QUAN XÁC THỰC <br>';
                                        echo 'Tên cơ quan:<br>';
                                        echo 'Số thứ tự xác nhận: .../...';
                                    } else {
                                        echo 'CHƯA XÉT DUYỆT CHỦ THỂ';
                                    }
                                    ?>
                                </td>
                                <td style="width: 20%"></td>
                                <td style="text-align: center">
                                    Ngày <?= date("d") ?> tháng <?= date("m")?> năm <?= date("Y")?> <br>
                                    NGƯỜI KHAI<br>
                                    <?php
                                    echo $model->ten;
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </tr>
                </table>
            </div>
        </div>
        <div class="panel-footer">
            <p>
                <button id="print" class="btn btn-success pull-left" onclick="printContent('printArea');" ><i class="glyphicon glyphicon-print"></i> In hồ sơ</button>
                <?= \yii\helpers\Html::a('<span class="fa fa-reply"></span> Quay lại',Yii::$app->request->referrer,['class'=>'btn btn-default pull-right'])?>
                <br>
            </p>
        </div>
    </div>


</div>


<script type="text/javascript">
    function printContent(el){
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        var enteredtext = $('#text').val();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
        $('#text').html(enteredtext);
    }
</script>
</body>
</html>
