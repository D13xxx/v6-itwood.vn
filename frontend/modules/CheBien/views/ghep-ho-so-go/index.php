<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/15/2019
 * Time: 11:51 AM
 */
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;


$scriptGhep = <<< EOD
    $(document).on('click', '.select_button', function() {
		$.ajax({
               url: '/che-bien/ghep-ho-so-go/chon-lo-go',
               type: 'post',
               data: {
                        id:$(this).val(),
						chon:1,
                         _csrf :''
                     },
               success: function (data) {
				  $.pjax.reload({container:'#selectRegHoSoGo'});
               }
          });

    });
	$(document).on('click', '.remove_button', function() {
		$.ajax({
               url: '/che-bien/ghep-ho-so-go/bo-lo-go',
               type: 'post',
               data: {
                        id:$(this).val(),
						chon:0,
                         _csrf :''
                     },
               success: function (data) {
                  //remove from grid or reload;
				  //reload div
				  $.pjax.reload({container:'#selectRegHoSoGo'});
               }
          });

    });
EOD;

$this->registerJs($scriptGhep);
?>

<?php Pjax::begin(['id' => 'selectRegHoSoGo']) ?>
<div class="ghep-ho-so-go">
    <div class="col-sm-7">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">Danh sách lô gỗ hiện có</h4>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-responsive" id="BangDuLieu">
                    <thead>
                    <tr>
                        <th>Mã hồ sơ</th>
                        <th>Cấp đường kính TB</th>
                        <th>Chiều dài</th>
                        <th>Số khúc</th>
                        <th>Khối lượng</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Mã hồ sơ</th>
                        <th>Cấp đường kính TB</th>
                        <th>Chiều dài</th>
                        <th>Select2</th>
                        <th>Khối lượng</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($model as $key => $giaTri){ ?>
                        <tr>
                            <td>
                                <?php
                                $hoSoGo = \common\models\RegHoSoGo::find()->where(['id'=>$giaTri->reg_ho_so_go_id])->one();
                                echo $hoSoGo->ma;
                                ?>
                            </td>
                            <td>
                                <?= $giaTri->cap_duong_kinh_trung_binh?>
                            </td>
                            <td><?= $giaTri->chieu_dai?></td>
                            <td><?= $giaTri->so_luong?></td>
                            <td>
                                <?php
                                echo ($giaTri->khoi_luong - $giaTri->khoi_luong_da_dung);
                                ?>
                            </td>
                            <td>
                                <?= \yii\helpers\Html::button('<span class="glyphicon glyphicon-plus"></span>',
                                    ['value'=>$giaTri->id,
                                    'class'=>'select_button',
                                    'title'=>'Lựa chọn lô gỗ']
                                )?>
                            </td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4 class="panel-title">Danh sách lô gỗ cần ghép</h4>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-responsive" id="BangDuLieu1">
                    <thead>
                    <tr>
                        <th>Mã hồ sơ</th>
                        <th>Cấp đường kính TB</th>
                        <th>Khối lượng</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Mã hồ sơ</th>
                        <th>Cấp đường kính TB</th>
                        <th>Khối lượng</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($modelTemp as $key => $giaTri1){ ?>
                        <tr>
                            <td>
                                <?php
                                $hoSoGo1 = \common\models\RegHoSoGo::find()->where(['id'=>$giaTri1->reg_ho_so_go_id])->one();
                                echo $hoSoGo1->ma;
                                ?>
                            </td>
                            <td>
                                <?= $giaTri1->cap_duong_kinh_trung_binh?>
                            </td>
                            <td>
                                <?php
                                echo ($giaTri1->khoi_luong - $giaTri1->khoi_luong_da_dung);
                                ?>
                            </td>
                            <td>
                                <?= \yii\helpers\Html::button('<span class="glyphicon glyphicon-remove"></span>',
                                    ['value'=>$giaTri1->id,
                                        'class'=>'remove_button',
                                        'title'=>'Bỏ ghép lô gỗ']
                                )?>
                            </td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>
                </table>
            </div>

                <?php
                $countGhep = count($modelTemp);
                if($countGhep>1){ ?>
            <div class="panel-footer">
                <?= \yii\helpers\Html::button('Thực hiện ghép',['class'=>'btn btn-primary']); ?>
            </div>
                <?php }
                ?>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<?php
$scriptJS = <<< JS
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#BangDuLieu thead tr:eq(1) th').each( function () {
        var title = $(this).text();
        if(title!==''){
			if(title =='Select2'){
				$(this).html('<select><option value=""></option></select>');
				
			}
			else {
				$(this).html( '<input type="text" placeholder="" class="form-control column_search" style="width:100%"/>' );    
			}
        }
    } );
 
    // DataTable
    var table = $('#BangDuLieu ').DataTable({
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
    
    $('#BangDuLieu1 thead tr:eq(1) th').each( function () {
        var title = $(this).text();
        if(title!==''){
            $(this).html( '<input type="text" placeholder="" class="form-control column_search" style="width:100%"/>' );    
        }
    } );
 
    // DataTable
    var table = $('#BangDuLieu1 ').DataTable({
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
    $('#BangDuLieu1 thead').on( 'keyup change', ".column_search",function () {
        table
            .column( $(this).parent().index() )
            .search( this.value )
            .draw();
    } );
} );
JS;

$this->registerJs($scriptJS);
?>
<?php Pjax::end() ?>
