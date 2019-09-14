<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/13/2019
 * Time: 11:28 AM
 */
?>

<?php
if($model != null) {?>
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
        </thead>
        <tbody>
        <?php
        if($model['totalFeatures']>0){
            $i =0;
            foreach ($model['features'] as $key => $value){ ?>
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
            $i++;}
        } else { ?>
            <tr>
                <td colspan="9">Không có dữ liệu về lô rừng</td>
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
<?php } else { echo 'Không có dữ liệu';} ?>
