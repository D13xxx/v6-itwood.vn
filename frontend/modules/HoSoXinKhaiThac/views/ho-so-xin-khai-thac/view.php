<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoXinKhaiThac */

$this->title = $model->ma;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Danh mục hồ sơ xin khai thác'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reg-ho-so-xin-khai-thac-view">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"> Xem chi tiết: <?= Html::encode($this->title) ?> </h4>
        </div>
        <div class="panel-body">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title"><?= Yii::t('frontend','Thông tin dự kiến khai thác')?>
                        <span class="pull-right">

                    </span>
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
                            [
                                'attribute'=>'phuong_an_bao_ve_rung',
                                'label'=>Yii::t('frontend','Chứng chỉ rừng (Mã số CCR)')
                            ],
                            [
                                'class'=>'yii\grid\actionColumn',
                                'template'=>'{update} {delete}',
                                'buttons'=>[
                                    'update'=>function($url,$data){
                                        $url = \yii\helpers\Url::to(['/ho-so-xin-khai-thac/ho-so-xin-khai-thac-bkls/update','id'=>$data->id]);
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,['title'=>Yii::t('frontend','Sửa')]);
                                    },
                                    'delete'=>function($url,$data) use ($model) {
                                        $url= \yii\helpers\Url::to(['/ho-so-xin-khai-thac/ho-so-xin-khai-thac-bkls/delete','id'=>$data->id,'hoSoDangKyKhaiThacID'=>$model->id]);
                                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,[
                                            'title'=>Yii::t('frontend','Xóa'),
                                            'data'=>[
                                                'confirm'=>Yii::t('frontend','Bạn có muốn loại bỏ lô rừng này không?'),
                                                'method'=>'post',
                                            ]
                                        ]);
                                    }
                                ],
                                'visibleButtons'=>[
                                    'update'=>function($data){
                                        return ($data->trang_thai_id==\common\models\RegHoSoXinKhaiThacBkls::TT_BKLS_MOI || $data->trang_thai_id== \common\models\RegHoSoXinKhaiThacBkls::TT_BKLS_KHONGDUOCDUYET);
                                    },
                                    'delete'=>function($data){
                                        return ($data->trang_thai_id==\common\models\RegHoSoXinKhaiThacBkls::TT_BKLS_MOI || $data->trang_thai_id== \common\models\RegHoSoXinKhaiThacBkls::TT_BKLS_KHONGDUOCDUYET);
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

            $thongTinTrongRung = GridView::widget([
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

            echo \yii\jui\Tabs::widget([
                'items'=>[
                    [
                        'label'=>Yii::t('frontend','Thông tin về lô rừng'),
                        'content'=>$thongTinLoRung,
                        'active'=>true
                    ],
                    [
                        'label'=>Yii::t('frontend','Thông tin về rừng trồng'),
                        'content'=>$thongTinTrongRung
                    ]
                ]
            ])
            ?>
            <br>
            <?php
            if($model->trang_thai_id==\common\models\RegHoSoXinKhaiThac::TT_HOSO_KHONGDUYET){ ?>
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?= Yii::t('frontend','Lý do không duyệt')?></h4>
                    </div>
                    <div class="panel-body">
                        <?= GridView::widget([
                            'dataProvider'=>$dataKhongDuyet,
                            'summary'=>'',
                            'columns'=>[
                                [
                                    'class'=>'yii\grid\SerialColumn',
                                    'contentOptions'=>['style'=>'vertical-align: middle'],
                                ],
                                'ly_do:html',
                                [
                                    'attribute'=>'nguoi_lap',
                                    'value'=>function($data){
                                        return $data->nguoiDung ? $data->nguoiDung->fullname : '';
                                    },
                                    'contentOptions'=>['style'=>'vertical-align: middle'],
                                ],
                                [
                                    'attribute'=>'ngay_lap',
                                    'value'=>function($data){
                                        return ($data->ngay_lap!=''||$data->ngay_lap!=null) ? date("d/m/Y H:i:s",strtotime($data->ngay_lap)) : '';
                                    },
                                    'contentOptions'=>['style'=>'vertical-align: middle'],
                                ]
                            ]
                        ])?>
                    </div>
                </div>
            <?php }
            ?>
        </div>
        <div class="panel-footer">
            <?php
            if($model->trang_thai_id==\common\models\RegHoSoXinKhaiThac::TT_HOSO_MOI || $model->trang_thai_id==\common\models\RegHoSoXinKhaiThac::TT_HOSO_KHONGDUYET){ ?>

                <?= Html::a(Yii::t('frontend','Thêm lô rừng khai thác'),
                    ['/ho-so-xin-khai-thac/chi-tiet-ho-so/create','hoSoKhaiThacID'=>$model->id],
                    ['class'=>'btn btn-primary']
                )?>

                <?= Html::a(Yii::t('backend', 'Đề nghị duyệt'), ['de-nghi-duyet', 'id' => $model->id], ['class' => 'btn btn-success']) ?>

            <?php }
            ?>
            <?php
            if($model->trang_thai_id==\common\models\RegHoSoXinKhaiThac::TT_HOSO_DUOCDUYET){
                echo Html::a(Yii::t('backend', 'In hồ sơ'), ['/ho-so-xin-khai-thac/in-ho-so/index','id'=>$model->id], ['class' => 'btn btn-success']);
            }
            ?>

            <?= Html::a(Yii::t('backend','Quay lại'),Yii::$app->request->referrer,['class'=>'btn btn-default'])?>
        </div>
    </div>

</div>
<div class="clearfix"></div>