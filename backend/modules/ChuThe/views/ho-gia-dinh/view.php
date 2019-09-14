<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RegChuTheToChuc */

$this->title = $model->ma;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Hồ sơ chủ thể'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reg-chu-the-to-chuc-view">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"> Xem chi tiết: <?= Html::encode($this->title) ?> </h4>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'ma',
                    'ten',
                    'so_cmtnd',
                    [
                        'attribute'=>'ngay_cap',
                        'value'=>function($data){
                            if($data->ngay_cap != ''|| $data->ngay_cap!=null){
                                return date("d/m/Y",strtotime($data->ngay_cap));
                            } else {
                                return '';
                            }
                        }
                    ],
                    'noi_cap',
                    'noi_thuong_tru',
                    [
                        'attribute'=>'tinh_thanh_id',
                        'value'=>function($data){
                            return $data->tinhThanh ? $data->tinhThanh->ten : '';
                        }
                    ],
                    [
                        'attribute'=>'quan_huyen_id',
                        'value'=>function($data){
                            return $data->quanHuyen ? $data->quanHuyen->ten : '';
                        }
                    ],
                    [
                        'attribute'=>'xa_phuong_id',
                        'value'=>function($data){
                            return $data->xaPhuong ? $data->xaPhuong->ten : '';
                        }
                    ],
                    [
                        'attribute'=>'loai_hinh_hoat_dong_id',
                        'format'=>'html',
                        'value'=>function($data){
                            if(strlen($data->loai_hinh_hoat_dong_id)>=1){
                                $arrayItems = explode(';',$data->loai_hinh_hoat_dong_id);
                                $loaiHinhHoatDong='';
                                foreach ($arrayItems as $item){
                                    $loaiHinhHoatDong .= '- '.\common\models\RegChuTheHoGiaDinh::LOAI_HINH_HOAT_DONG_ARRAY[$item].'<br>';
                                }

                                return $loaiHinhHoatDong;
                            }
                        }
                    ],
                    'so_dien_thoai',
                    'email:email',
                    [
                        'attribute'=>'nguoi_duyet',
                        'value'=>function($data){
                            return $data->nguoiDuyet ? $data->nguoiDuyet->fullname : '';
                        }
                    ],
                    [
                        'attribute'=>'ngay_duyet',
                        'value'=>function($data){
                            if($data->ngay_duyet !='' || $data->ngay_duyet != null){
                                return date("d/m/Y H:i:s",strtotime($data->ngay_duyet));
                            } else {
                                return '';
                            }
                        }
                    ],
                    [
                        'attribute'=>'trang_thai_id',
                        'value'=>function($data){
                            return \common\models\RegChuTheHoGiaDinh::TRANG_THAI_ARRAY[$data->trang_thai_id];
                        }
                    ],
                    [
                        'attribute'=>'file_dinh_kem',
                        'format'=>'html',
                        'value'=>function($data){
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
                    ],
                ],
            ]) ?>
            <div class="clearfix"></div>
            <?php
            if($model->trang_thai_id==\common\models\RegChuTheHoGiaDinh::TT_NOACTIVE){
                echo '<div><h4>Lý do không duyệt</h4></div>';
                echo Yii::$app->runAction('/chu-the/ho-gia-dinh/ly-do-khong-duyet',['id'=>$model->id]);
            }
            ?>
        </div>
        <div class="panel-footer">
            <?php
            if($model->trang_thai_id == \common\models\RegChuTheHoGiaDinh::TT_NEWREG){
                echo Html::a(Yii::t('backend', 'Phê duyệt'), ['duyet-chu-the','id'=>$model->id], [
                    'class' => 'btn btn-primary',
                    'data'=>[
                        'method'=>'POST',
                        'confirm'=>Yii::t('backend','Bạn có xác định duyệt chủ thể này hày không?')
                    ]
                ]);
                echo Html::button(Yii::t('backend', 'Không duyệt'), ['id' => 'modelButton', 'value' => \yii\helpers\Url::to(['/chu-the/ho-gia-dinh/khong-duyet', 'id' => $model->id]), 'class' => 'btn btn-danger']);
//                echo Html::a(Yii::t('backend', 'Không duyệt'), [], ['class' => 'btn btn-danger']);
            }
            if($model->trang_thai_id == \common\models\RegChuTheHoGiaDinh::TT_ACTIVE){
                echo Html::a(Yii::t('backend', 'In hồ sơ Chủ thể'), ['/chu-the/in-ho-so/index','id'=>$model->id,'loaiChuThe'=>0], ['class' => 'btn btn-success']);
            }
            ?>
            <?php
            if($model->trang_thai_id==\common\models\RegChuTheHoGiaDinh::TT_NEWREG){
                echo Html::a(Yii::t('backend','Quay lại'),['de-nghi-duyet'],['class'=>'btn btn-default']);
            }
            if($model->trang_thai_id==\common\models\RegChuTheHoGiaDinh::TT_ACTIVE){
                echo Html::a(Yii::t('backend','Quay lại'),['da-duoc-duyet'],['class'=>'btn btn-default']);
            }
            if($model->trang_thai_id==\common\models\RegChuTheHoGiaDinh::TT_NOACTIVE){
                echo Html::a(Yii::t('backend','Quay lại'),['khong-duoc-duyet'],['class'=>'btn btn-default']);
            }
            ?>
        </div>
    </div>

</div>

<?php

\yii\bootstrap\Modal::begin([
    'header' => '<h4>Không duyệt chủ thể</h4>',
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