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
            <div id="printArea" style="margin-bottom: 100px">
                <div style="font-weight: bold; text-align: center">
                    CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                    Độc lập - Tự do - Hạnh phúc<br>
                </div>
                <table class="table gridPrintTableNoBoder">
                    <tr>
                        <td style="width: 83%">
                            <h3 style="text-align: center;font-weight: bold;font-family: 'Times New Roman'">HỒ SƠ LÔ RỪNG</h3>
                            <div style="text-align: center;font-weight: bold;font-family: 'Times New Roman'">
                                (Đối với:<?php if($modelQSD->loai_chu_the_id==1){ echo 'Tổ chức'; } else {echo 'Hộ gia đình';}?> )
                            </div>
                        </td>
                        <td style="font-size: 12px">
                            Mẫu số: 01/QRLR
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
                                    if($modelQSD->loai_chu_the_id==1){
                                        if($modelChuThe->xa_phuong_id ==''||$modelChuThe->xa_phuong_id==null){
                                            $tenXa='';
                                        } else {
                                            $modelXaCount = \common\models\XaPhuong::find()->where(['id'=>$modelChuThe->xa_phuong_id]);
                                            if($modelXaCount->count()>0){
                                                $modelXa = $modelXaCount->one();
                                                $tenXa = $modelXa->ten;
                                            } else {
                                                $tenXa='';
                                            }
                                        }

                                        if($modelChuThe->quan_huyen_id ==''||$modelChuThe->quan_huyen_id==null){
                                            $tenQuanHuyen='';
                                        } else {
                                            $modelQuanCount = \common\models\QuanHuyen::find()->where(['id'=>$modelChuThe->quan_huyen_id]);
                                            if($modelQuanCount->count()>0){
                                                $modelQuanHuyen = $modelQuanCount->one();
                                                $tenQuanHuyen = $modelQuanHuyen->ten;
                                            } else {
                                                $tenQuanHuyen='';
                                            }
                                        }

                                        if($modelChuThe->tinh_thanh_id ==''||$modelChuThe->tinh_thanh_id==null){
                                            $tenTinh='';
                                        } else {
                                            $modelTinhCount = \common\models\TinhThanh::find()->where(['id'=>$modelChuThe->tinh_thanh_id]);
                                            if($modelTinhCount->count()>0){
                                                $modelTinhThanh = $modelTinhCount->one();
                                                $tenTinh = $modelTinhThanh->ten;
                                            } else {
                                                $tenTinh='';
                                            }
                                        }
                                        echo '1) Tên tổ  chức: ' . $modelChuThe->ten_to_chuc .'     Mã tổ chức:'.$modelChuThe->ma.'<br>';
                                        echo '2) Địa chỉ trụ sở chính:' . $modelChuThe->dia_chi_tru_so .' - '.$tenXa.' - '.$tenQuanHuyen.' - '.$tenTinh.'<br>';
                                        echo '3) Liên hệ: Email: ' .$modelChuThe->email . '; Điện thoại: '.$modelChuThe->so_dien_thoai.'<br>';
                                    } else {
                                        if($modelChuThe->xa_phuong_id ==''||$modelChuThe->xa_phuong_id==null){
                                            $tenXa='';
                                        } else {
                                            $modelXaCount = \common\models\XaPhuong::find()->where(['id'=>$modelChuThe->xa_phuong_id]);
                                            if($modelXaCount->count()>0){
                                                $modelXa = $modelXaCount->one();
                                                $tenXa = $modelXa->ten;
                                            } else {
                                                $tenXa='';
                                            }
                                        }

                                        if($modelChuThe->quan_huyen_id ==''||$modelChuThe->quan_huyen_id==null){
                                            $tenQuanHuyen='';
                                        } else {
                                            $modelQuanCount = \common\models\QuanHuyen::find()->where(['id'=>$modelChuThe->quan_huyen_id]);
                                            if($modelQuanCount->count()>0){
                                                $modelQuanHuyen = $modelQuanCount->one();
                                                $tenQuanHuyen = $modelQuanHuyen->ten;
                                            } else {
                                                $tenQuanHuyen='';
                                            }
                                        }

                                        if($modelChuThe->tinh_thanh_id ==''||$modelChuThe->tinh_thanh_id==null){
                                            $tenTinh='';
                                        } else {
                                            $modelTinhCount = \common\models\TinhThanh::find()->where(['id'=>$modelChuThe->tinh_thanh_id]);
                                            if($modelTinhCount->count()>0){
                                                $modelTinhThanh = $modelTinhCount->one();
                                                $tenTinh = $modelTinhThanh->ten;
                                            } else {
                                                $tenTinh='';
                                            }
                                        }
                                        echo '1) Tên chủ rừng: ' . $modelChuThe->ten .'     Mã chủ rừng:'.$modelChuThe->ma.'<br>';
                                        echo '2) Địa chỉ thường trú:' . $modelChuThe->noi_thuong_tru .' - '.$tenXa.' - '.$tenQuanHuyen.' - '.$tenTinh.'<br>';
                                        echo '3) Liên hệ: Email: ' .$modelChuThe->email . '; Điện thoại: '.$modelChuThe->so_dien_thoai.'<br>';
                                    } ?>
                                </td>
                            </tr>
                        </table>
                    </tr>

                    <tr>
                        <h4 style="font-weight: bold">II.THÔNG TIN QUYỀN SỬ DỤNG ĐẤT</h4>
                    </tr>
                    <tr>
                        <table class="gridPrinttable table-bordered" style="width: 100%">
                            <tr>
                                <th style="text-align: center">Mã CN QSDD</th>
                                <th style="text-align: center">Loại văn bản QSDĐ</th>
                                <th style="text-align: center">Số hiệu VB QSDĐ</th>
                                <th style="text-align: center">Ngày văn bản</th>
                                <th style="text-align: center">Số vào sổ văn bản</th>
                                <th style="text-align: center">Cơ quan ban hành văn bản</th>
                            </tr>
                            <tr>
                                <td style="text-align: center"><?= $modelQSD->ma?></td>
                                <td style="text-align: center"><?= $modelQSD->loaiQuyenSuDungDat? $modelQSD->loaiQuyenSuDungDat->ten : ''?></td>
                                <td style="text-align: center"><?= $modelQSD->so_van_ban ?></td>
                                <td style="text-align: center"><?= date("d/m/Y",strtotime($modelQSD->ngay_ban_hanh)) ?></td>
                                <td style="text-align: center"><?= $modelQSD->so_vao_so ?></td>
                                <td style="text-align: center"><?= $modelQSD->co_quan_ban_hanh ?></td>
                                </td>
                            </tr>
                        </table>
                    </tr>

                    <tr>
                        <br>
                        <h4 style="font-weight: bold">III.THÔNG TIN VỀ LÔ RỪNG</h4>
                    </tr>
                    <tr>
                        <table class="gridPrinttable table-bordered" style="width: 100%">
                            <tr>
                                <th style="text-align: center">Mã CN QSDD</th>
                                <th style="text-align: center">Loại rừng</th>
                                <th style="text-align: center">Diện tích (ha)</th>
                                <th style="text-align: center">Tiểu khu</th>
                                <th style="text-align: center">Khoảnh</th>
                                <th style="text-align: center">Lô</th>
                                <th style="text-align: center">Số thửa đất</th>
                                <th style="text-align: center">Địa chỉ lô rừng</th>
                                <th style="text-align: center">Mã Lô rừng</th>
                            </tr>
                            <tr>
                                <td style="text-align: center"><?= $modelQSD->ma ?></td>
                                <td style="text-align: center"><?= $modelLoRung->loaiRung ? $modelLoRung->loaiRung->ten : '' ?></td>
                                <td style="text-align: center"><?= $modelLoRung->dien_tich ?></td>
                                <td style="text-align: center"><?= $modelLoRung->tieu_khu?></td>
                                <td style="text-align: center"><?= $modelLoRung->khoanh?></td>
                                <td style="text-align: center"><?= $modelLoRung->lo?></td>
                                <td style="text-align: center"><?= $modelLoRung->so_thua_dat?></td>
                                <td style="text-align: center">
                                    <?php
                                    if($modelLoRung->xa_phuong_id ==''||$modelLoRung->xa_phuong_id==null){
                                        $tenXa='';
                                    } else {
                                        $modelXaCount = \common\models\XaPhuong::find()->where(['id'=>$modelLoRung->xa_phuong_id]);
                                        if($modelXaCount->count()>0){
                                            $modelXa = $modelXaCount->one();
                                            $tenXa = $modelXa->ten;
                                        } else {
                                            $tenXa='';
                                        }
                                    }

                                    if($modelLoRung->quan_huyen_id ==''||$modelLoRung->quan_huyen_id==null){
                                        $tenQuanHuyen='';
                                    } else {
                                        $modelQuanCount = \common\models\QuanHuyen::find()->where(['id'=>$modelLoRung->quan_huyen_id]);
                                        if($modelQuanCount->count()>0){
                                            $modelQuanHuyen = $modelQuanCount->one();
                                            $tenQuanHuyen = $modelQuanHuyen->ten;
                                        } else {
                                            $tenQuanHuyen='';
                                        }
                                    }

                                    if($modelLoRung->tinh_thanh_id ==''||$modelLoRung->tinh_thanh_id==null){
                                        $tenTinh='';
                                    } else {
                                        $modelTinhCount = \common\models\TinhThanh::find()->where(['id'=>$modelLoRung->tinh_thanh_id]);
                                        if($modelTinhCount->count()>0){
                                            $modelTinhThanh = $modelTinhCount->one();
                                            $tenTinh = $modelTinhThanh->ten;
                                        } else {
                                            $tenTinh='';
                                        }
                                    }

                                    echo $modelLoRung->dia_chi . ' - '.$tenXa.' - '.$tenQuanHuyen.' - '.$tenTinh;
                                    ?>
                                </td>
                                <td style="text-align: center">
                                    <?php
                                    if($modelLoRung->trang_thai_id==\common\models\RegLoRung::TT_RUNGDUOCDUYET){
                                        $qrCode = (new QrCode($modelLoRung->ma))
                                            ->setSize(80)
                                            ->setMargin(5)
                                            ->useForegroundColor(0, 0, 0);
                                        echo '<img src="'. $qrCode->writeDataUri().'">';
                                    }  else {
                                        echo '';
                                    }
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
                                </td>
                                <td style="width: 20%"></td>
                                <td style="text-align: center">
                                    Ngày <?= date("d") ?> tháng <?= date("m")?> năm <?= date("Y")?> <br>
                                    NGƯỜI KHAI<br>
                                    <?php
                                    if($modelQSD->loai_chu_the_id==1){
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
