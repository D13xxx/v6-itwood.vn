<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\RegHoSoXinKhaiThac */

$this->title = $model->id;
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
                        <?= Html::a(Yii::t('frontend','Thêm lô rừng khai thác'),[
                            '/ho-so-xin-khai-thac/chi-tiet-ho-so/create','hoSoKhaiThacID'=>$model->id
                        ],[
                            'class'=>'btn btn-xs btn-primary'
                        ])?>
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
                            'reg_lo_rung_id',
                            'dien_tich_khai_thac',
                            'phuong_thuc_khai_thac_id',
                            'tuoi_rung_khai_thac',
                            'so_cay_hien_tai',
                            'd13_cay_pho_bien',
                            'san_luong_du_kien',
                            'phuong_an_bao_ve_rung'
                        ]
                    ])?>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title"><?= Yii::t('frontend','Thông tin về lô rừng')?></h4>
                </div>
                <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider'=>$dataBKLS,
                        'summary'=>'',
                        'columns'=>[
                            'reg_lo_rung_id',
                            'reg_lo_rung_id',
                            'reg_lo_rung_id',
                            'reg_lo_rung_id',
                            'reg_lo_rung_id',
                        ]
                    ])?>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title"><?= Yii::t('frontend','Thông tin về rừng trồng')?></h4>
                </div>
                <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider'=>$dataTrongRung,
                        'summary'=>'',
                        'columns'=>[
                            'reg_lo_rung_id',
                            'loai_cay_trong_id',
                            'phuong_thuc_trong_id',
                            'nam_trong',
                            'loai_von_dau_tu_id',
                            'chu_so_huu'
                        ]
                    ])?>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <?= Html::a(Yii::t('frontend','Thêm lô rừng khai thác'),
                ['/ho-so-xin-khai-thac/chi-tiet-ho-so/create','hoSoKhaiThacID'=>$model->id],
                ['class'=>'btn btn-primary']
            )?>
            <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
        </div>
    </div>

</div>
<div class="clearfix"></div>