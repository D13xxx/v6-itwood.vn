<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/29/2019
 * Time: 3:41 PM
 */
use yii\grid\GridView;
use yii\widgets\Pjax;

?>
<?php Pjax::begin(['enablePushState'=>false]); ?>
<?= GridView::widget([
    'summary'=>'',
    'dataProvider'=>$dataProvider,
    'tableOptions' =>['class' => 'table table-striped table-bordered','id'=>'BangDuLieu'],
    'columns'=>[
        ['class'=>'yii\grid\SerialColumn'],
        [
            'attribute'=>'ma',
        ],
        [
            'attribute'=>'tieu_khu',
        ],
        [
            'attribute'=>'khoanh',
        ],
        [
            'attribute'=>'lo',
        ],
        'dien_tich',
        'so_thua_dat',
        [
            'attribute'=>'dia_chi',
        ],
        [
            'attribute'=>'tinh_thanh_id',
        ],
        [
            'attribute'=>'quan_huyen_id',
        ],
        [
            'attribute'=>'xa_phuong_id',
        ]
    ]
])?>
<?php Pjax::end() ?>
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