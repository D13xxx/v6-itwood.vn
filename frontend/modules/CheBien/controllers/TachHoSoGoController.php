<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/28/2019
 * Time: 3:38 PM
 */

namespace frontend\modules\CheBien\controllers;

use common\models\RegHoSoGo;
use common\models\RegHoSoGoChiTiet;
use common\models\RegHoSoGoChiTietTemp;
use common\models\searchs\RegHoSoGoChiTietSearch;
use common\models\searchs\RegHoSoGoSearch;
use frontend\controllers\base\PController;
use Yii;
use yii\web\NotFoundHttpException;

class TachHoSoGoController extends PController
{
    public function actionIndex()
    {
        $search = new RegHoSoGoSearch();
        $dataProvider = $search->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['trang_thai_id'=>RegHoSoGo::TT_HSG_DUOCDUYET]);
        $dataProvider->query->andWhere(['reg_chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')]);
        $dataProvider->query->andWhere(['reg_loai_hinh_chu_the'=>Yii::$app->session->get('reg_loai_chu_the_id')]);

        return $this->render('index',[
           'search'=>$search,
           'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        $search = new RegHoSoGoChiTietSearch();
        $dataProvider = $search->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_ho_so_go_id'=>$model->id]);
        $dataProvider->query->andWhere(['>','(khoi_luong-khoi_luong_da_dung)',0]);

        if(Yii::$app->request->post()){
            $selects = Yii::$app->request->post('selection');
            if(!isset($selects)){
                Yii::$app->session->setFlash('error','Chưa chọn lô gỗ nào để tách hồ sơ');
                return $this->redirect(['view','id'=>$id]);
            }
            //Kiểm tra thông tin nhập vào
            foreach ($selects as $value)
            {
                $soLuongTach = Yii::$app->request->post('so_luong_tach_'.$value);
                $khoiLuongTach = Yii::$app->request->post('khoi_luong_tach_'.$value);

                $HoSoGoChiTietTam = RegHoSoGoChiTiet::find()->where(['id'=>$value])->one();

                if($soLuongTach==''||$soLuongTach==null){
                    Yii::$app->session->setFlash('error','Số lượng (khúc) tách không được để trống');
                    return $this->redirect(['view','id'=>$id]);
                }
                if(!is_numeric($soLuongTach)){
                    Yii::$app->session->setFlash('error','Số lượng (khúc) tách phải là số');
                    return $this->redirect(['view','id'=>$id]);
                }
                if($soLuongTach<=0){
                    Yii::$app->session->setFlash('error','Số lượng (khúc) tách phải lớn hơn 0');
                    return $this->redirect(['view','id'=>$id]);
                }
                if($khoiLuongTach==''||$khoiLuongTach==null){
                    Yii::$app->session->setFlash('error','Khối lượng tách không được để trống');
                    return $this->redirect(['view','id'=>$id]);
                }
                if(!is_numeric($khoiLuongTach)){
                    Yii::$app->session->setFlash('error','Khối lượng tách phải là số');
                    return $this->redirect(['view','id'=>$id]);
                }
                if($khoiLuongTach<=0){
                    Yii::$app->session->setFlash('error','Khối lượng tách phải lớn hơn 0');
                    return $this->redirect(['view','id'=>$id]);
                }
                if($HoSoGoChiTietTam->khoi_luong - $HoSoGoChiTietTam->khoi_luong_da_dung - $khoiLuongTach < 0){
                    Yii::$app->session->setFlash('error','Khối lượng tách vượt quá khối lượng đang còn');
                    return $this->redirect(['view','id'=>$id]);
                }
            }

            //Thực hiện tách hồ sơ gỗ
            foreach ($selects as $value) {
                $soLuongTach = Yii::$app->request->post('so_luong_tach_' . $value);
                $khoiLuongTach = Yii::$app->request->post('khoi_luong_tach_' . $value);

                $hoSoGoChiTiet = RegHoSoGoChiTiet::find()->where(['id'=>$value])->one();

                $hoSoGoChiTietTach = new RegHoSoGoChiTietTemp();
                $dataHoSoGoChiTiet = $hoSoGoChiTiet->attributes;
                $hoSoGoChiTietTach->setAttributes($dataHoSoGoChiTiet);
                $hoSoGoChiTietTach->khoi_luong=$khoiLuongTach;
                $hoSoGoChiTietTach->so_luong=$soLuongTach;

                $hoSoGoChiTiet->khoi_luong_da_dung = $hoSoGoChiTiet->khoi_luong_da_dung+$khoiLuongTach;
                $hoSoGoChiTiet->so_luong = $hoSoGoChiTiet->so_luong-$soLuongTach;

//                echo '<pre>';
//                print_r($hoSoGoChiTiet);
//                exit();

                $hoSoGoChiTiet->save();
                $hoSoGoChiTietTach->save();
            }

            $hoSoGo = new RegHoSoGo();
            $hoSoGo->ma=uniqid();
            $hoSoGo->ngay_lap=date("Y-m-d H:i:s");
            $hoSoGo->reg_chu_the_id=Yii::$app->session->get('reg_chu_the_id');
            $hoSoGo->trang_thai_id=RegHoSoGo::TT_HSG_DUOCDUYET;
            $hoSoGo->nguoi_duyet = Yii::$app->session->get('reg_chu_the_id');
            $hoSoGo->ngay_duyet=date("Y-m-d H:i:s");
            $hoSoGo->reg_loai_hinh_chu_the = Yii::$app->session->get('reg_loai_chu_the_id');
            $hoSoGo->tinh_thanh_id = $model->trang_thai_id;
            $hoSoGo->quan_huyen_id = $model->quan_huyen_id;
            $hoSoGo->xa_phuong_id = $model->xa_phuong_id;
            $hoSoGo->ho_so_goc = 0;
            $hoSoGo->save();
            $idMoi = $hoSoGo->id;
            $temp = RegHoSoGoChiTietTemp::find()->where(['reg_ho_so_go_id'=>$id])->all();
            foreach ($temp as $giaTri){
                $giaTri->reg_ho_so_go_id= $hoSoGo->id;
                $giaTri->save();
                $dataMoi = $giaTri->attributes;
                $chiTietMoi = new RegHoSoGoChiTiet();
                $chiTietMoi->setAttributes($dataMoi);
                $chiTietMoi->khoi_luong_da_dung=0;
                $chiTietMoi->reg_chu_the_id=Yii::$app->session->get('reg_chu_the_id');
                $chiTietMoi->loai_chu_the_id = Yii::$app->session->get('reg_loai_chu_the_id');
                $chiTietMoi->save();
            }

            //Xóa toàn bộ dữ liệu tạm sau khi đã tách gỗ thành công
            RegHoSoGoChiTietTemp::deleteAll(['reg_ho_so_go_id'=>$id]);
            RegHoSoGoChiTietTemp::deleteAll(['reg_ho_so_go_id'=>$idMoi]);
            Yii::$app->session->setFlash('success','Tách hồ sơ lô gỗ thành công. Lô gỗ mới có mã là:'. $hoSoGo->ma);
            return $this->redirect('index');
        }

        return $this->render('view',[
           'model'=>$model,
            'dataProvider'=>$dataProvider,
        ]);
    }

    protected function findModel($id)
    {
        if(($model=RegHoSoGo::findOne($id))!==null){
            return $model;
        }

        throw new NotFoundHttpException('Không tìm thấy hồ sơ gỗ');
    }
}