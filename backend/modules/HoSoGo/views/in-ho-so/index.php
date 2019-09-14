<?php
use Da\QrCode\QrCode;
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
                            <h3 style="text-align: center;font-weight: bold;font-family: 'Times New Roman'">BẢNG KÊ KHAI SINH LÔ GỖ HỢP PHÁP</h3>
                            <div style="text-align: center;font-weight: bold;font-family: 'Times New Roman'">
                                (Đối với:<?php if($modelUser->loai_chu_the_id==1){ echo 'Tổ chức'; } else {echo 'Hộ gia đình';}?> )
                            </div>
                        </td>
                        <td style="font-size: 12px">
                            Mẫu số: 04QRHSG
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
                        <h4 style="font-weight: bold">I.THÔNG TIN CHỦ LÂM SẢN</h4>
                    </tr>
                    <tr>
                        <table class="gridPrintTableNoBoder" style="width: 100%">
                            <tr>
                                <td style="width: 80%">
                                    <?php

                                    if($model->reg_loai_hinh_chu_the==1){
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
                                        echo '2) Mã số chứng nhận ĐKKD: ' . $modelChuThe->giay_dang_ky_kd.'<br>';
                                        echo '3) Mã số thuế: ' . $modelChuThe->ma_so_thue .'<br>';
                                        echo '4) Tên người đại diện hợp pháp: ' . $modelChuThe->nguoi_dai_dien .'<br>';
                                        echo '5) Số CMTND: ' . $modelChuThe->so_cmtnd .' Ngày cấp: '.$modelChuThe->ngay_cap.' Nơi cấp: '.$modelChuThe->noi_cap.'<br>';
                                        echo '6) Địa chỉ trụ sở chính:' . $modelChuThe->dia_chi_tru_so .' - '.$tenXa.' - '.$tenQuanHuyen.' - '.$tenTinh.'<br>';
                                        echo '7) Website:' . $modelChuThe->website .'<br>';
                                        echo '8) Liên hệ: Email: ' .$modelChuThe->email . '; Điện thoại: '.$modelChuThe->so_dien_thoai.'<br>';
                                        if($model->giao_dich == \common\models\RegHoSoGo::TT_GIAODICH_YES){
                                            $soHoaDon='';
                                            $ngayHoaDon='';
                                        } else {
                                            $soHoaDon ='';
                                            $ngayHoaDon ='';
                                        }
                                        echo '9) Số hóa đơn kèm theo (nếu có): ' .$soHoaDon . '; Ngày HĐ: '.$ngayHoaDon.'<br>';
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
                                        echo '1) Tên chủ lâm sản: ' . $modelChuThe->ten .'     Mã chủ thể:'.$modelChuThe->ma.'<br>';
                                        echo '2) Số CMTND: ' . $modelChuThe->so_cmtnd .' Ngày cấp: '.date("d/m/Y",strtotime($modelChuThe->ngay_cap)).' Nơi cấp: '.$modelChuThe->noi_cap.'<br>';
                                        echo '3) Mã số thuế: ' .'<br>';
                                        echo '4) Địa chỉ thường trú: ' .$modelChuThe->noi_thuong_tru .' - '.$tenXa.' - '.$tenQuanHuyen.' - '.$tenTinh.'<br>';
                                        echo '5) Liên hệ: Email: ' .$modelChuThe->email . '; Điện thoại: '.$modelChuThe->so_dien_thoai.'<br>';
                                        if($model->giao_dich == \common\models\RegHoSoGo::TT_GIAODICH_YES){
                                            $soHoaDon='';
                                            $ngayHoaDon='';
                                        } else {
                                            $soHoaDon ='';
                                            $ngayHoaDon ='';
                                        }
                                        echo '6) Số hóa đơn kèm theo (nếu có): ' .$soHoaDon . '; Ngày HĐ: '.$ngayHoaDon.'<br>';
                                    } ?>
                                </td>
                                <td>
                                    <div class="img-thumbnail" style="text-align: center">
                                        <span style="font-weight: bold">HỒ SƠ GỖ</span>
                                        <?php
                                        $qrCode = (new QrCode($model->ma))
                                            ->setSize(80)
                                            ->setMargin(5)
                                            ->useForegroundColor(0, 0, 0);
                                        echo '<img src="'. $qrCode->writeDataUri().'">';
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </tr>

                    <tr>
                        <h4 style="font-weight: bold">II.THÔNG TIN LÔ GỖ KHAI THÁC</h4>
                    </tr>
                    <tr>
                        <table class="gridPrinttable table-bordered" style="width: 100%">
                            <tr>
                                <th rowspan="2" style="text-align: center">Mã lô rừng</th>
                                <th colspan="2" style="text-align: center">Tên gỗ/Loài cây</th>
                                <th colspan="2" style="text-align: center">Quy cách gỗ</th>
                                <th rowspan="2" style="text-align: center">Số lượng (khúc)</th>
                                <th rowspan="2" style="text-align: center">Khối lượng (m3)</th>
                            </tr>
                            <tr>
                                <th>Tên phổ thông</th>
                                <th>Tên khoa học</th>
                                <th>Cấp đường kính trung bình (cm)</th>
                                <th>Chiều dài (m)</th>
                            </tr>
                            <?php
                            foreach ($dataChiTiet as $chiTietHoSo){
                                $bkls= \common\models\RegHoSoXinKhaiThacBkls::find()->where(['id'=>$chiTietHoSo->reg_ho_so_xin_khai_thac_id])->one();
                                ?>
                                <tr>
                                    <td style="text-align: center">
                                        <?php
                                        if($bkls->loRung){
                                            $qrCode2 = (new QrCode($bkls->loRung->ma))
                                                ->setSize(80)
                                                ->setMargin(5)
                                                ->useForegroundColor(0, 0, 0);
                                            echo '<img src="'. $qrCode2->writeDataUri().'">';
                                        } else { echo '';}
                                        ?>
                                    <td style="text-align: center"><?= $bkls->loaiCayTrong ? $bkls->loaiCayTrong->ten : ''; ?></td>
                                    <td style="text-align: center"><?= $bkls->loaiCayTrong ? $bkls->loaiCayTrong->ten_khoa_hoc : ''; ?></td>
                                    <td style="text-align: center"><?= $chiTietHoSo->cap_duong_kinh_trung_binh ?></td>
                                    <td style="text-align: center"><?= $chiTietHoSo->chieu_dai ?></td>
                                    <td style="text-align: center"><?= $chiTietHoSo->so_luong ?></td>
                                    <td style="text-align: center"><?= $chiTietHoSo->khoi_luong ?></td>
                                    </td>
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
                                    if($model->reg_loai_hinh_chu_the==1){
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