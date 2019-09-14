<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

$this->title = Yii::t('backend', 'Danh sách lô rừng Formis');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <?= Html::encode($this->title) ?>
        </h4>
    </div>
    <div class="panel-body">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title"><?= Yii::t('backend','Tìm kiếm theo địa danh')?></h4>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'layout' => 'inline' ,
                    'class' => 'form-inline' ,
                ]); ?>

                <?php
                $tinhThanh=\common\models\TinhThanh::find()->all();
                $listTinhThanh=\yii\helpers\ArrayHelper::map($tinhThanh,'id','ten')
                ?>
                <?= $form->field($model,'tinh_thanh_id')->widget(\kartik\select2\Select2::className(),[
                    'data'=>$listTinhThanh,
                    'options'=>[
                        'prompt'=>Yii::t('frontend','Lựa chọn tỉnh thành'),
                        'onchange'=>'
                        $.get( "'.\yii\helpers\Url::toRoute('/dia-danh-hanh-chinh/quan-huyen/danh-sach-quan-huyen').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'quan_huyen_id').'" ).html( data );
                            }
                        );
                    '
                    ],
                    'pluginOptions'=>['allowClear'=>true, 'width' => '200px',]
                ])->label('Tỉnh thành')?>

                <?php
                if(is_null($model->tinh_thanh_id))
                {
                    $listQuanHuyen=array();
                }else {
                    $quanHuyen=\common\models\QuanHuyen::find()->where(['tinh_thanh_id'=>$model->tinh_thanh_id])->all();
                    $listQuanHuyen=\yii\helpers\ArrayHelper::map($quanHuyen,'id','ten');
                }
                ?>
                <?= $form->field($model, 'quan_huyen_id')->widget(\kartik\select2\Select2::className(),[
                    'data'=>$listQuanHuyen,
                    'options'=>[
                        'prompt'=>Yii::t('frontend','Lựa chọn quận huyện'),
                        'onchange'=>'
                        $.get( "'.\yii\helpers\Url::toRoute('/dia-danh-hanh-chinh/xa-phuong/danh-sach-xa-phuong').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'xa_phuong_id').'" ).html( data );
                            }
                        );
                    '
                    ],
                    'pluginOptions'=>['allowClear'=>true,'width' => '200px',]
                ])->label('Quận huyện') ?>

                <?php
                if(is_null($model->xa_phuong_id))
                {
                    $listXaPhuong=array();
                }else {
                    $xaPhuong=\common\models\XaPhuong::find()->where(['quan_huyen_id'=>$model->quan_huyen_id])->all();
                    $listXaPhuong=\yii\helpers\ArrayHelper::map($xaPhuong,'id','ten');
                }
                ?>
                <?= $form->field($model, 'xa_phuong_id')->widget(\kartik\select2\Select2::className(),[
                    'data'=>$listXaPhuong,
                    'options'=>[
                        'prompt'=>Yii::t('frontend','Lựa chọn xã phường'),
                    ],
                    'pluginOptions'=>['allowClear'=>true,'width' => '200px']
                ])->label('Xã phường') ?>

                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('backend', '<i class="glyphicon glyphicon-search"></i>  Tìm kiếm'), ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4 class="panel-title"><?= Yii::t('backend','Danh sách kết quả')?></h4>
            </div>
            <div class="panel-body">
                <?php
                if($modelTimKiem != null) { ?>
                    <table class="table table-bordered table-responsive" id="BangDuLieu">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tiểu khu</th>
                            <th>Khoảnh</th>
                            <th>Lô</th>
                            <th>Diện tích</th>
                            <th>Loại đất</th>
                            <th>Thời hạn SD</th>
                            <th>Lô cũ</th>
                            <th>Địa chỉ</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Tiểu khu</th>
                            <th>Khoảnh</th>
                            <th>Lô</th>
                            <th>Diện tích</th>
                            <th>Loại đất</th>
                            <th>Thời hạn SD</th>
                            <th>Lô cũ</th>
                            <th>Địa chỉ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i =0;
//                                    print_r($modelTimKiem); exit();
                        foreach ($modelTimKiem['features'] as $key => $value){ ?>
                            <tr>
                                <td><?= $i+1;?></td>
                                <td><?= $value['properties']['tk']?></td>
                                <td><?= $value['properties']['khoanh']?></td>
                                <td><?= $value['properties']['lo']?></td>
                                <td><?= $value['properties']['dtich']?></td>
                                <td><?= $value['properties']['ldlr']?></td>
                                <td><?= $value['properties']['thoihansd']?></td>
                                <td><?= $value['properties']['locu']?></td>
                                <td><?= $value['properties']['ddanh'] .'-'.$value['properties']['xa'].'-'.$value['properties']['huyen'].'-'.$value['properties']['tinh']?></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<< JS
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#BangDuLieu thead tr:eq(1) th').each( function () {
        var title = $(this).text();
        if(title!=='#'){
            $(this).html( '<input type="text" placeholder="" class="form-control column_search" style="width:100%"/>' );    
        }
    } );
 
    // DataTable
    var table = $('#BangDuLieu').DataTable({
        orderCellsTop: true,
        //searching: false,
        language: {
            "search": 'Lọc thông tin:',
            "lengthMenu": "Hiển thị _MENU_ số bảng ghi trên trang",
            "zeroRecords": "Không tìm thấy dữ liệu",
            "info": "Trang _PAGE_ trên tổng số _PAGES_ trang",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(tìm trong _MAX_ bảng ghi)",
            "paginate": {
                "next": ">>",
                "previous": "<<"
            }
        },
         "sDom":"ltipr"
    });
 
    // Apply the search
    $('#BangDuLieu thead').on( 'keyup change', ".column_search",function () {
        table
            .column( $(this).parent().index() )
            .search( this.value )
            .draw();
    } );
} );
JS;
$this->registerJs($script);
?>

<div class="clearfix"></div>
