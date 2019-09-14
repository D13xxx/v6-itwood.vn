<?php
use Da\QrCode\QrCode;
use common\models\RegHoSoXinKhaiThacBkls;
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
                <table class="table gridPrintTableNoBoder">
                    <tr>
                        <td style="width: 83%">
                            <h3 style="text-align: center;font-weight: bold;font-family: 'Times New Roman'">HỒ SƠ ĐĂNG KÝ KHAI THÁC</h3>
                            <div style="text-align: center;font-weight: bold;font-family: 'Times New Roman'">
                                (Đối với:<?php if($model->loai_hinh_chu_the_id==1){ echo 'Tổ chức'; } else {echo 'Hộ gia đình';}?> )
                            </div>
                        </td>
                        <td style="font-size: 12px">
                            Mẫu số: 01/QRDKKT
                            <br>Ký hiệu:
                            <?php
                            $quyenDuyet = \backend\models\AuthAssignment::find()->where(['user_id'=>$model->nguoi_duyet_id])->one();
                            if($quyenDuyet->item_name=='UBNDXA'||$quyenDuyet->item_name=='UBNDHUYEN'){
                                echo 'UBND/ITWOOD';
                            }
                            if($quyenDuyet->item_name=='HATKIEMLAM'||$quyenDuyet || $quyenDuyet=='CHICUCKIEMLAM'){
                                echo 'HKL/ITWOOD';
                            }
                            if($quyenDuyet->item_name == 'Admin'){
                                echo 'AD/ITWOOD';
                            }
                            ?>
                            <br>Số: ............
                        </td>
                    </tr>
                </table>

                <br>

                <table class="table-bordered" style="width: 100%">
                    <img src="/themes/img/logo.png" alt="" style="position: fixed; z-index: 200 ;opacity: 0.1;width: 100%; margin-top: 50px; transform:rotate(300deg);
        -webkit-transform:rotate(300deg); text-align: center; vertical-align: middle">
                    <tr>
                        <h4 style="font-weight: bold">I.THÔNG TIN CHỦ RỪNG</h4>
                    </tr>
                    <tr>
                        <table class="gridPrintTableNoBoder" style="width: 100%">
                            <tr>
                                <td style="width: 80%">
                                    <?php
                                    if($model->loai_hinh_chu_the_id==1){
                                        echo '1) Tên tổ  chức: ' . $modelChuThe->ten_to_chuc .'     Mã tổ chức:'.$modelChuThe->ma.'<br>';
                                        echo '2) Địa chỉ trụ sở chính:' . $modelChuThe->dia_chi_tru_so .'<br>';
                                        echo '3) Liên hệ: Email: ' .$modelChuThe->email . '; Điện thoại: '.$modelChuThe->so_dien_thoai.'<br>';
                                    } else {
                                        echo '1) Tên chủ HGĐ: ' . $modelChuThe->ten .'     Mã chủ thể:'.$modelChuThe->ma.'<br>';
                                        echo '2) Địa chỉ thường trú:' . $modelChuThe->noi_thuong_tru .'<br>';
                                        echo '3) Liên hệ: Email: ' .$modelChuThe->email . '; Điện thoại: '.$modelChuThe->so_dien_thoai.'<br>';
                                    } ?>
                                </td>
                                <td>
                                    <?php
                                    if($model->trang_thai_id==\common\models\RegHoSoXinKhaiThac::TT_HOSO_DUOCDUYET || $model->trang_thai_id == \common\models\RegHoSoXinKhaiThac::TT_HOSO_DACHUYENDOI){
                                    ?>
                                    <div class="img-thumbnail" style="text-align: center">
                                        <span style="font-weight: bold">Đăng ký khai thác</span>
                                        <?php

                                            if($model->ma !=''||$model->ma != null){
                                                $qrCode = (new QrCode($model->ma))
                                                    ->setSize(80)
                                                    ->setMargin(5)
                                                    ->useForegroundColor(0, 0, 0);
                                                echo '<img src="'. $qrCode->writeDataUri().'">';
                                            } else {
                                                echo '';
                                            }
                                        ?>
                                    </div>
                                    <?php
                                    } else {
                                        echo '';
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </tr>

                    <tr>
                        <h4 style="font-weight: bold">II.THÔNG TIN ĐĂNG KÝ KHAI THÁC</h4>
                    </tr>
                    <tr>
                        <td>
                            Tổng diện tích khai thác (ha): <?= $model->dien_tich_khai_thac?> (ha)<br>
                            Thời gian dự kiến khai thác: Từ ngày: <?= date("d/m/Y",strtotime($model->ngay_bat_dau))?> đến ngày: <?= date("d/m/Y",strtotime($model->ngay_ket_thuc)) ?>
                        </td>

                        <table class="gridPrinttable table-bordered" style="width: 100%">
                            <tr>
                                <th style="text-align: center" rowspan="2">Mã lô rừng</th>
                                <th style="text-align: center" rowspan="2">Tiểu khu</th>
                                <th style="text-align: center" rowspan="2">Khoảnh</th>
                                <th style="text-align: center" rowspan="2">Lô</th>
                                <th style="text-align: center" colspan="2">Loài cây</th>
                                <th style="text-align: center" rowspan="2">Phương thức trồng</th>
                                <th style="text-align: center" rowspan="2">Năm trồng</th>
                                <th style="text-align: center" rowspan="2">Loại vốn đầu tư</th>
                                <th style="text-align: center" rowspan="2">Chủ sở hữu rừng</th>
                                <th style="text-align: center" rowspan="2">Diện tích khai thác</th>
                                <th style="text-align: center" rowspan="2">Phương thức KT</th>
                                <th style="text-align: center" rowspan="2">Tuổi rừng KT</th>
                                <th style="text-align: center" rowspan="2">Số cây hiện tại</th>
                                <th style="text-align: center" rowspan="2">D13 Cây phổ biến (cm)</th>
                                <th style="text-align: center" rowspan="2">Sản lượng dự kiến (m3)</th>
                                <th style="text-align: center" rowspan="2">Phương án QLR BV/CCR</th>
                            </tr>
                            <tr>
                                <th style="text-align: center">Tên thông thường</th>
                                <th style="text-align: center">Tên khoa học</th>
                            </tr>
                            <?php
                            //                            print_r($dataBKLS->models);
                            foreach ($dataBKLS->models as $bangKeLamSan){
//                                $loRung = \common\models\RegLoRung::find()->where(['id'=>$bangKeLamSan['reg_lo_rung_id']])->one();
                                $loRung=RegHoSoXinKhaiThacBkls::ThongTinLoRung($bangKeLamSan['reg_lo_rung_id']);
                                $loaiCay = RegHoSoXinKhaiThacBkls::ThongTinLoaiCay($bangKeLamSan['loai_cay_trong_id']);
                                $PhuongThucTrong = RegHoSoXinKhaiThacBkls::PhuongThucTrong($bangKeLamSan['phuong_thuc_trong_id']);
                                $PhuongThucKhaiThac = RegHoSoXinKhaiThacBkls::PhuongThucKhaiThac($bangKeLamSan['phuong_thuc_khai_thac_id']);
                                $LoaiVonDauTu = RegHoSoXinKhaiThacBkls::LoaiVonDauTu($bangKeLamSan['loai_von_dau_tu_id']);
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        if($loRung->trang_thai_id == \common\models\RegLoRung::TT_RUNGDUOCDUYET){
                                            $qrCode = (new QrCode($loRung->ma))
                                                ->setSize(80)
                                                ->setMargin(5)
                                                ->useForegroundColor(0, 0, 0);
                                            echo '<img src="'. $qrCode->writeDataUri().'">';
                                        }else {
                                            echo '';
                                        }
                                        ?>
                                    </td>
                                    <td style="text-align: center"><?= $loRung->tieu_khu;?></td>
                                    <td style="text-align: center"><?= $loRung->khoanh;?></td>
                                    <td style="text-align: center"><?= $loRung->lo;?></td>
                                    <td ><?= $loaiCay->ten;?></td>
                                    <td><?= $loaiCay->ten_khoa_hoc;?></td>
                                    <td style="text-align: center"><?= $PhuongThucTrong->ten;?></td>
                                    <td style="text-align: center"><?= $bangKeLamSan['nam_trong'];?></td>
                                    <td style="text-align: center"><?= $LoaiVonDauTu->ten;?></td>
                                    <td style="text-align: center"><?= $bangKeLamSan['chu_so_huu'];?></td>
                                    <td style="text-align: center"><?= $bangKeLamSan['dien_tich_khai_thac'];?></td>
                                    <td style="text-align: center"><?= $PhuongThucKhaiThac->ten;?></td>
                                    <td style="text-align: center"><?= $bangKeLamSan['tuoi_rung_khai_thac'];?></td>
                                    <td style="text-align: center"><?= $bangKeLamSan['so_cay_hien_tai'];?></td>
                                    <td style="text-align: center"><?= $bangKeLamSan['d13_cay_pho_bien'];?></td>
                                    <td style="text-align: center"><?= $bangKeLamSan['san_luong_du_kien'];?></td>
                                    <td style="text-align: center"><?= $bangKeLamSan['phuong_an_bao_ve_rung'];?></td>
                                </tr>
                            <?php }
                            ?>
                        </table>
                    </tr>

                    <tr>
                        <br>
                        <table class="table-borderd" style="width: 100%">
                            <tr>
                                <td style="width: 40%; text-align: center">
                                </td>
                                <td style="width: 20%"></td>
                                <td style="text-align: center">
                                    Ngày <?= date("d") ?> tháng <?= date("m")?> năm <?= date("Y")?> <br>
                                    NGƯỜI KHAI<br>
                                    <?php
                                    if($model->loai_hinh_chu_the_id==1){
                                        echo $modelChuThe->ten_to_chuc;
                                    } else {
                                        echo $modelChuThe->ten;
                                    }
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

