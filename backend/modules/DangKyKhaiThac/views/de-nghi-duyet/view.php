<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/19/2019
 * Time: 2:16 PM
 */
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = Yii::t('backend','Thông tin Hồ sơ đăng ký khai thác');

?>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"> Xem chi tiết: <?= Html::encode($this->title) ?> </h4>
        </div>
        <div class="panel-body">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title"><?= Yii::t('frontend','Thông tin đề nghị khai thác')?>
                    </h4>
                </div>
                <div class="panel-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'ma',
                            'dien_tich_khai_thac',
                            [
                                'attribute'=>'ngay_bat_dau',
                                'value'=>function($data)
                                {
                                    return ($data->ngay_bat_dau!=''||$data->ngay_bat_dau!=null)? date("d/m/Y",strtotime($data->ngay_bat_dau)) : '';
                                }
                            ],
                            [
                                'attribute'=>'ngay_ket_thuc',
                                'value'=>function($data)
                                {
                                    return ($data->ngay_ket_thuc!=''||$data->ngay_ket_thuc!=null)? date("d/m/Y",strtotime($data->ngay_ket_thuc)) : '';
                                }
                            ],
                            [
                                'attribute'=>'trang_thai_id',
                                'format'=>'html',
                                'value'=>function($data){
                                    return \common\models\RegHoSoXinKhaiThac::TT_HOSO_LABEL()[$data->trang_thai_id];
                                }
                            ],
                        ],
                    ]) ?>
                    <?= GridView::widget([
                        'dataProvider'=>$dataBKLS,
                        'summary'=>'',
                        'columns'=>[
                            ['class'=>'yii\grid\SerialColumn'],
                            [
                                'label'=>Yii::t('frontend','Mã lô rừng'),
                                'value'=>function($data){
                                    return $data->loRung ? $data->loRung->ma : '';
                                }
                            ],
                            'dien_tich_khai_thac',
                            [
                                'attribute'=>'phuong_thuc_khai_thac_id',
                                'value'=>function($data){
                                    return $data->phuongThucKhaiThac ? $data->phuongThucKhaiThac->ten : '';
                                }
                            ],
                            'tuoi_rung_khai_thac',
                            'so_cay_hien_tai',
                            'd13_cay_pho_bien',
                            'san_luong_du_kien',
                            'phuong_an_bao_ve_rung',
                            [
                                'class'=>'yii\grid\actionColumn',
                                'template'=>'{update} {delete}',
                                'buttons'=>[
                                    'update'=>function($url,$data){
                                        $url = \yii\helpers\Url::to(['/ho-so-xin-khai-thac/ho-so-xin-khai-thac-bkls/update','id'=>$data->id]);
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,['title'=>Yii::t('frontend','Sửa')]);
                                    },
                                    'delete'=>function($url,$data){
                                        $url= \yii\helpers\Url::to(['/ho-so-xin-khai-thac/ho-so-xin-khai-thac-bkls/delete','id'=>$data->id]);
                                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,[
                                            'title'=>Yii::t('frontend','Xóa'),
                                            'data'=>['method'=>'post']
                                        ]);
                                    }
                                ],
                                'visibleButtons'=>[
                                    'update'=>function($data){
                                        return ($data->trang_thai_id==\common\models\RegHoSoXinKhaiThacBkls::TT_BKLS_MOI);
                                    },
                                    'delete'=>function($data){
                                        return ($data->trang_thai_id==\common\models\RegHoSoXinKhaiThacBkls::TT_BKLS_MOI);
                                    }
                                ]
                            ]
                        ]
                    ])?>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php
            $thongTinLoRung = GridView::widget([
                'dataProvider'=>$dataBKLS,
                'summary'=>'',
                'columns'=>[
                    ['class'=>'yii\grid\SerialColumn'],
                    [
                        'label'=>Yii::t('frontend','Mã lô rừng'),
                        'value'=>function($data){
                            return $data->loRung ? $data->loRung->ma : '';
                        }
                    ],
                    [
                        'label'=>Yii::t('frontend','Tiểu khu'),
                        'value'=>function($data){
                            return $data->loRung ? $data->loRung->tieu_khu : '';
                        }
                    ],
                    [
                        'label'=>Yii::t('frontend','Khoảnh'),
                        'value'=>function($data){
                            return $data->loRung ? $data->loRung->khoanh : '';
                        }
                    ],
                    [
                        'label'=>Yii::t('frontend','Lô'),
                        'value'=>function($data){
                            return $data->loRung ? $data->loRung->lo : '';
                        }
                    ],
                    [
                        'label'=>Yii::t('frontend','Địa chỉ lô rừng'),
                        'value'=>function($data){
                            return $data->loRung ? $data->loRung->dia_chi : '';
                        }
                    ],
                ]
            ]);

            $thongTinRungTrong = GridView::widget([
                'dataProvider'=>$dataBKLS,
                'summary'=>'',
                'columns'=>[
                    ['class'=>'yii\grid\SerialColumn'],
                    [
                        'label'=>Yii::t('frontend','Mã lô rừng'),
                        'value'=>function($data){
                            return $data->loRung ? $data->loRung->ma : '';
                        }
                    ],
                    [
                        'label'=>Yii::t('frontend','Tên phổ thông'),
                        'value'=>function($data){
                            return $data->loaiCayTrong ? $data->loaiCayTrong->ten : '';
                        }
                    ],
                    [
                        'label'=>Yii::t('frontend','Tên khoa học'),
                        'value'=>function($data){
                            return $data->loaiCayTrong ? $data->loaiCayTrong->ten_khoa_hoc : '';
                        }
                    ],
                    [
                        'attribute'=>'phuong_thuc_trong_id',
                        'value'=>function($data)
                        {
                            return $data->phuongThucTrong ? $data->phuongThucTrong->ten : '';
                        }
                    ],
                    'nam_trong',
                    [
                        'attribute'=>'loai_von_dau_tu_id',
                        'value'=>function($data){
                            return $data->loaiVonDauTu ? $data->loaiVonDauTu->ten : '';
                        }
                    ],
                    'chu_so_huu'
                ]
            ]);

            $thongTinTrachNhiemTuanThu= GridView::widget([
                'dataProvider'=>$dataTNTT,
                'summary'=>'',
                'columns'=>[
                    [
                        'attribute'=>'reg_lo_rung_id',
                        'value'=>function($data){
                            return $data->loRung ? $data->loRung->ma : '';
                        }
                    ],
                    [
                        'attribute'=>'reg_trach_nhiem_tuan_thu_id',
                        'value'=>function($data){
                            return $data->trachNhiemTuanThu ? $data->trachNhiemTuanThu->ten : '';
                        }
                    ],
                    [
                        'attribute'=>'gia_tri',
                        'value'=>function($data){
                            return $data->gia_tri==1 ? "Có" : "Không" ;
                        }
                    ],
                    [
                        'attribute'=>'file_dinh_kem',
                        'format'=>'html',
                        'value'=>function($data){
                            $linkImage= Yii::getAlias('@linkImages/uploads/trach-nhiem-tuan-thu/');
                            if(strlen($data->file_dinh_kem)>=1){
                                $fileArray = explode(';',$data->file_dinh_kem);
                                $link='';
                                foreach ($fileArray as $file){
                                    $link .= Html::a($file,['view-file','id'=>$data->id,'fileName'=>$file],[
                                            'class'=>'windowPopUp'
                                        ]).'<br>';
                                }
                                return $link;
                            }
                        }
                    ]
                ]
            ])
            ?>
            <?= \yii\jui\Tabs::widget([
                'items'=>[
                    [
                        'label'=>Yii::t('backend','Thông tin về lô rừng'),
                        'content'=>$thongTinLoRung,
                        'active'=>true
                    ],
                    [
                        'label'=>Yii::t('frontend','Thông tin về rừng trồng'),
                        'content'=>$thongTinRungTrong,
                    ],
                    [
                        'label'=>Yii::t('backend','Trách nhiệm tuân thủ'),
                        'content'=>$thongTinTrachNhiemTuanThu,
                    ],
                ]
            ])?>
            <br>

            <?= \yii\jui\Tabs::widget([
                'items'=>[
                    [
                        'label'=>Yii::t('backend','Lịch sử khai thác'),
                        'content'=>$this->render('_lich_su_khai_thac',['dataBKLS'=>$dataBKLS]),
                        'active'=>true
                    ],
                    [
                        'label'=>Yii::t('frontend','Lịch sử không duyệt hồ sơ'),
                        'content'=>$this->render('_lich_su_khong_duyet',['idHoSoKhaiThac'=>$model->id]),
                    ],
                ]
            ])?>
        </div>
        <div class="panel-footer">
            <?php
            if($model->trang_thai_id != \common\models\RegHoSoXinKhaiThac::TT_HOSO_KHONGDUYET){
                echo Html::a(Yii::t('backend', 'Duyệt hồ sơ'), ['duyet-ho-so','id'=>$model->id], ['class' => 'btn btn-primary']);
                echo Html::button(Yii::t('backend', 'Không duyệt hồ sơ'), ['id' => 'modelButton', 'value' => \yii\helpers\Url::to(['/dang-ky-khai-thac/de-nghi-duyet/khong-duyet', 'id' => $model->id]), 'class' => 'btn btn-danger']);
            }
            ?>
            <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
        </div>
    </div>
    <div class="clearfix"></div>
<?php

\yii\bootstrap\Modal::begin([
    'header' => '<h4>Không duyệt hồ sơ đăng ký khai thác</h4>',
    'id'     => 'model',
    'size'   => 'model-lg',
]);

echo "<div id='modelContent'></div>";

\yii\bootstrap\Modal::end();

?>
    <div class="clearfix"></div>
<?php
$script = <<<JS
$(function(){
    $('#modelButton').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
});
JS;

$this->registerJs($script);
?>