<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/28/2019
 * Time: 10:38 AM
 */
use yii\grid\GridView;
use yii\helpers\Html;

?>
<?php
if($idLoaiChuThe ==1){
    echo GridView::widget([
        'dataProvider'=>$dataChuThe,
        'summary'=>'',
        'tableOptions' =>['class' => 'table table-striped table-bordered','id'=>'BangDuLieu'],
        'columns'=>[
            'ma',
            'ten_to_chuc',
            'giay_dang_ky_kd',
            'ma_so_thue',
            [
                'class'=>'yii\grid\ActionColumn',
                'template'=>'{select}',
                'buttons'=>[
                    'select' => function($url, $model, $key){
                        return Html::button('Lựa chọn', [
                            'title' => Yii::t('frontend', 'Lựa chọn'),
                            'aria-label' => Yii::t('frontend', 'Lựa chọn'),
                            'class' => 'btn btn-success select-row',
                            'data-id' => $model->id,
                            'data-ma' => $model->ma,
                            'data-ten' => $model->ten_to_chuc,
                            'data-cmtnd' => $model->ma_so_thue,
                            'data-mst' => $model->ma_so_thue,
                        ]);

                    },
                ]
            ]
        ]
    ]);
} else {
    echo GridView::widget([
        'dataProvider'=>$dataChuThe,
        'summary'=>'',
        'tableOptions' =>['class' => 'table table-striped table-bordered','id'=>'BangDuLieu'],
        'columns'=>[
            'ma',
            'ten',
            'so_cmtnd',
//            'ma_so_thue',
            [
                'class'=>'yii\grid\ActionColumn',
                'template'=>'{select}',
                'buttons'=>[
                    'select' => function($url, $model, $key){
                        return Html::button('Lựa chọn', [
                            'title' => Yii::t('frontend', 'Lựa chọn'),
                            'aria-label' => Yii::t('frontend', 'Lựa chọn'),
                            'class' => 'btn btn-success select-row',
                            'data-id' => $model->id,
                            'data-ma' => $model->ma,
                            'data-ten' => $model->ten,
                            'data-cmtnd' => $model->so_cmtnd,
                            'data-mst' => $model->so_cmtnd,
                        ]);

                    },
                ]
            ]
        ]
    ]);
}
?>
<?php
$script= <<< JS
    
$(document).on('click', '.select-row', function(){    
    // get id from custom button    
    var id = $(this).attr('data-id');
    var ma = $(this).attr('data-ma');
    var ten = $(this).attr('data-ten');
    var cmtnd = $(this).attr('data-cmtnd');
    var mst = $(this).attr('data-mst');
    $('.modal').modal('hide');
    $('#reg_chu_the_moi_id').val(id);
    $('#ten_chu_the').val(ten);
    $('#so_cmtnd').val(cmtnd);
    $('#ma_so_thue').val(mst);
});
    
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