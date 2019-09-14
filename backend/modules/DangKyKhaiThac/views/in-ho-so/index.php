<?php
use Da\QrCode\QrCode;
use common\models\RegHoSoXinKhaiThacBkls;
?>
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
                            Mẫu số: 03QRDKKT
                            <br>Ký hiệu: AD/ITWOOD
                            <br>Số: ............
                        </td>
                    </tr>
                </table>
                <br>

                <table class="table-bordered" style="width: 100%">
                    <img src="/css/logo.png" alt="" style="position: fixed; z-index: 200 ;opacity: 0.1;width: 100%; margin-top: 50px; transform:rotate(300deg);
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
                                        echo '1) Tên chủ HGĐ: ' . $modelChuThe->ten .'     Mã chủ thể:'.$modelChuThe->ma.'<br>';
                                        echo '2) Địa chỉ thường trú:' . $modelChuThe->noi_thuong_tru . ' - '.$tenXa.' - '.$tenQuanHuyen.' - '.$tenTinh.'<br>';
                                        echo '3) Liên hệ: Email: ' .$modelChuThe->email . '; Điện thoại: '.$modelChuThe->so_dien_thoai.'<br>';
                                    } ?>
                                </td>
                                <td>
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
<div class="clearfix"></div>