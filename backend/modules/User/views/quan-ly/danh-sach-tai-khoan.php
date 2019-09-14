<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/15/2019
 * Time: 2:07 PM
 */
use yii\grid\GridView;

?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">Danh sách tài khoản</h4>
    </div>
    <div class="panel-body">
        <?= GridView::widget([
            'dataProvider'=>$dataProvider,
            'filterModel'=>$searchModel,
            'columns'=>[
                ['class'=>'yii\grid\SerialColumn'],
                [
                    'attribute'=>'fullname',
                    'label'=>'Tên đầy đủ'
                ],
                [
                    'attribute'=>'username',
                    'label'=>'Tài khoản đăng nhập'
                ],
                [
                    'attribute'=>'nhom_tai_khoan',
                    'label'=>'Nhóm tài khoản',
                    'value'=>function($data){
                        return $data->nhomTaiKhoan ? $data->nhomTaiKhoan->item_name : null;
                    }
                ],
                [
                    'attribute'=>'sys_tinh_thanh_id',
                    'label'=>'Tỉnh thành',
                    'value'=>function($data){
                        $tinhThanhID_array=explode(';',$data->sys_tinh_thanh_id);
                        $tenTinhThanh='';
                        foreach ($tinhThanhID_array as $tinhThanhID){
                            $tam= \common\models\TinhThanh::find()->where(['id'=>$tinhThanhID]);
                            if($tam->count()>0){
                                $modelTinhThanh = $tam->one();
                                $tenTinhThanh.=$modelTinhThanh->ten.';';
                            }
                        }
                        return $tenTinhThanh;
//                        return $data->tinhThanh ? $data->tinhThanh->ten : '';
                    }
                ],
                [
                    'attribute'=>'sys_quan_huyen_id',
                    'label'=>'Quận huyện',
                    'value'=>function($data){
                        $quanHuyenArray=explode(';',$data->sys_quan_huyen_id);
                        $tenQuanHuyen='';
                        foreach ($quanHuyenArray as $quanHuyenID){
                            $tamQH= \common\models\QuanHuyen::find()->where(['id'=>$quanHuyenID]);
                            if($tamQH->count()>0){
                                $modelQuanHuyen = $tamQH->one();
                                $tenQuanHuyen.=$modelQuanHuyen->ten.';';
                            }
                        }
                        return $tenQuanHuyen;
//                        return $data->quanHuyen ? $data->quanHuyen->ten : '';
                    }
                ],
                [
                    'attribute'=>'sys_xa_phuong_id',
                    'label'=>'Xã phường',
                    'value'=>function($data){
                        $xaPhuongArray=explode(';',$data->sys_xa_phuong_id);
                        $tenXaPhuong='';
                        foreach ($xaPhuongArray as $xaPhuongID){
                            $tamXP= \common\models\XaPhuong::find()->where(['id'=>$xaPhuongID]);
                            if($tamXP->count()>0){
                                $modelXaPhuong = $tamXP->one();
                                $tenXaPhuong.=$modelXaPhuong->ten.';';
                            }
                        }
                        return $tenXaPhuong;
//                        return $data->xaPhuong ? $data->xaPhuong->ten : '';
                    }
                ],
                [
                    'label'=>'Ngày tạo tài khoản',
                    'value'=>function($data){
                        return date("d/m/Y",$data->created_at);
                    }
                ],
//                [
//                    'class'=>'yii\grid\ActionColumn'
//                ]
            ]
        ])?>
    </div>
</div>
