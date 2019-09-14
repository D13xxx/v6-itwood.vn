<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\RegLoRungSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Danh sách lô rừng');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-lo-rung-index">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?= Html::encode($this->title) ?>
            </h4>
        </div>
        <div class="panel-body">
            <?php Pjax::begin(['id'=>'danhSachLoRung']); ?>
            <?= GridView::widget([
                'id'=>'gridLoRung',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pjax'=>true,
                'hover' => true,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'ma',
                    'tieu_khu',
                    'khoanh',
                    'lo',
                    'dia_chi',
                    'dien_tich',
                    'so_thua_dat',
                    //'tinh_thanh_id',
                    //'quan_huyen_id',
                    //'xa_phuong_id',
                    //'loai_rung_id',


                    //'nguoi_tao_id',
                    //'ngay_tao',
                    //'nguoi_sua_id',
                    //'ngay_sua',
                    //'nguoi_duyet_id',
                    //'ngay_duyet',
                    [
                        'attribute'=>'quyen_sdd_id',
                        'format'=>'html',
                        'value'=>function($data){
                            return $data->quyenSuDungDat ? Html::a($data->quyenSuDungDat->ma,['/quyen-su-dung-dat-va-rung/quyen-su-dung-dat-va-rung/view','id'=>$data->quyen_sdd_id]) : null;
                        },
                        'group' => true,
                        'contentOptions'=>['style'=>'vertical-align:middle']
                    ],
                    //'chu_the_id',
                    [
                        'attribute'=>'trang_thai_id',
                        'filter'=>\common\models\RegLoRung::TT_ARRAY(),
                        'format'=>'html',
                        'value'=>function($data){
                            return \common\models\RegLoRung::TT_ARRAY()[$data->trang_thai_id];
                        }
                    ],
                    [
                        'class'=>'yii\grid\CheckboxColumn',
                        'checkboxOptions'=> function($data){
                            if(($data->trang_thai_id == \common\models\RegLoRung::TT_RUNGMOIKHAIBAO || $data->trang_thai_id == \common\models\RegLoRung::TT_RUNGKHONGDUOCDUYET)){
                                return ['disabled'=>false];
                            }
                            return ['disabled'=>true];
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} {update} {delete}',
                        'visibleButtons'=>[
                            'delete'=>function($data){
                                return ($data->trang_thai_id == \common\models\RegLoRung::TT_RUNGMOIKHAIBAO || $data->trang_thai_id == \common\models\RegLoRung::TT_RUNGKHONGDUOCDUYET);
                            },
                            'update'=>function($data){
                                return ($data->trang_thai_id == \common\models\RegLoRung::TT_RUNGMOIKHAIBAO || $data->trang_thai_id == \common\models\RegLoRung::TT_RUNGKHONGDUOCDUYET);
                            }
                        ]
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="panel-footer">
            <button type="button" id="btnSubmit" class="btn btn-success">Đề nghị duyệt</button>
        </div>
    </div>

</div>
<?php
$scriptPost = <<< JS
$("#btnSubmit").click(function() {
    var keys = $('#gridLoRung').yiiGridView('getSelectedRows');
    if(typeof keys !== 'undefined' && keys.length > 0){
        var dialog = confirm("Bạn có muốn chuyển duyệt các lô rừng này không?");
        if (dialog == true) {
            $.ajax({
                type: "POST",
                url: '/quyen-su-dung-dat-va-rung/lo-rung/de-nghi-duyet', // Your controller action
                data: {keylist: keys},
                success: function(result){
                  $.pjax.reload({container:"#danhSachLoRung"}) 
                }
              });
        }
    }else{
         alert('Bạn chưa chọn lô rừng nào để xét duyệt');
        // console.log(keys);
    }
});
JS;
$this->registerJs($scriptPost,\yii\web\View::POS_READY);
?>