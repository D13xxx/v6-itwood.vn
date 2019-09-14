<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/28/2019
 * Time: 3:50 PM
 */
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$this->title = Yii::t('frontend','Tách hồ sơ gỗ: ').$model->ma;
?>
<div class="tach-ho-so-go">
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"><?= Html::encode($this->title) ?> </h4>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model'=>$model,
                'attributes'=>[
                    'ma',
                    [
                        'label'=>'Tổng khối lượng',
                        'value'=>function($data){
                            return \common\models\RegHoSoGo::TongKhoiLuongLoGo($data->id);
                        }
                    ],
                ]
            ])?>

            <?= GridView::widget([
                'dataProvider'=>$dataProvider,
                'summary'=>'',
                'tableOptions' =>['class' => 'table table-striped table-bordered','id'=>'BangDuLieu'],
                'columns'=>[
                    [
                        'label'=>'Mã lô rừng',
                        'value'=>function($data){
                            return $data->loRung ? $data->loRung->ma : '';
                        }
                    ],
                    'cap_duong_kinh_trung_binh',
                    'chieu_dai',
                    'so_luong',
                    [
                        'label'=>'Khối lượng (m3)',
                        'value'=>function($data){
                            if($data->khoi_luong_da_dung==''||$data->khoi_luong_da_dung==null){
                                $khoiLuongDaDung =0;
                            } else {
                                $khoiLuongDaDung=$data->khoi_luong_da_dung;
                            }
                            $khoiLuongConLai = $data->khoi_luong - $khoiLuongDaDung;
                            return $khoiLuongConLai;
                        }
                    ],
                    [
                        'label'=>'Số lượng tách (khúc)',
                        'format'=>'raw',
                        'value'=>function($data){
                            return Html::textInput('so_luong_tach_'.$data->id,null,['class'=>'form-control']);
                        }
                    ],
                    [
                        'label'=>'Khối lượng tách (m3)',
                        'format'=>'raw',
                        'value'=>function($data){
                            return Html::textInput('khoi_luong_tach_'.$data->id,null,['class'=>'form-control']);
                        }
                    ],
                    [
                        'class'=>'yii\grid\CheckboxColumn',
                    ]
                ],
            ])?>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('frontend','Thực hiện tách'),['class'=>'btn btn-primary'])?>
            <?= Html::a(Yii::t('backend','Quay lại'),['index'],['class'=>'btn btn-default'])?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$script = <<< JS
$(document).ready(function() {
    $('#BangDuLieu').DataTable( {
        // "paging":   false,
        "ordering": false,
        "info":     false,
        "language": {
            "search": 'Lọc thông tin:',
            "lengthMenu": "Hiển thị _MENU_ số bảng ghi trên trang",
            "zeroRecords": "Không tìm thấy dữ liệu",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "paginate": {
                "next": ">>",
                "previous": "<<"
            }
        },
        
    } );
} );
JS;

$this->registerJs($script);
?>