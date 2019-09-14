<?php
use yii\grid\GridView;
?>

<table class="table table-bordered table-hover">
    <tbody>
    <?php
    foreach ($dataBKLS->models as $lichSuTrongKhaiThac){
        $dataLichSu = \common\models\RegHoSoXinKhaiThacBkls::LichSuKhaiThac($lichSuTrongKhaiThac['reg_ho_so_xin_khai_thac_id'],$lichSuTrongKhaiThac['reg_lo_rung_id']);
        ?>
        <tr>
            <td>
                Lô rừng: <?php
                $regLoRung = \common\models\RegHoSoXinKhaiThacBkls::ThongTinLoRung($lichSuTrongKhaiThac['reg_lo_rung_id']);
                echo $regLoRung->ma;
                ?>
            </td>
        </tr>
        <tr>
            <td >
                <?= GridView::widget([
                    'dataProvider'=> $dataLichSu,
                    'summary'=>'',
                    'columns'=>[
                        [
                            'attribute'=>'reg_lo_rung_id',
                            'value'=>function($data){
                                return $data->loRung ? $data->loRung->ma : '';
                            }
                        ],
                        [
                            'label'=>'Diện tích lô rừng',
                            'value'=>function($data){
                                return $data->loRung ? $data->loRung->dien_tich : '';
                            }
                        ],
                        'dien_tich_khai_thac',
                        [
                            'attribute'=>'loai_cay_trong_id',
                            'value'=>function($data){
                                return $data->loaiCayTrong ? $data->loaiCayTrong->ten : '';
                            }
                        ],
                        [
                            'attribute'=>'phuong_thuc_khai_thac_id',
                            'value'=>function($data){
                                return $data->phuongThucKhaiThac ? $data->phuongThucKhaiThac->ten : '';
                            }
                        ],
                        'san_luong_du_kien',
                        [
                            'label'=>Yii::t('backend','Từ ngày'),
                            'value'=>function($data){
                                return $data->hoSoXinKhaiThac ? date("d/m/Y",strtotime($data->hoSoXinKhaiThac->ngay_bat_dau)) : '';
                            }
                        ],
                        [
                            'label'=>Yii::t('backend','Đến ngày'),
                            'value'=>function($data){
                                return $data->hoSoXinKhaiThac ? date("d/m/Y",strtotime($data->hoSoXinKhaiThac->ngay_ket_thuc)) : '';
                            }
                        ],
                    ]
                ])?>
            </td>

        </tr>
    <?php }
    ?>
    </tbody>
</table>