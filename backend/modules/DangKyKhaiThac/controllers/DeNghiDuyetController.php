<?php

namespace backend\modules\DangKyKhaiThac\controllers;

use common\models\RegHoSoXinKhaiThac;
use common\models\RegHoSoXinKhaiThacBkls;
use common\models\RegHoSoXinKhaiThacTuanThu;
use common\models\RegHoSoXnKhaiThacKhongDuyet;
use common\models\searchs\RegHoSoXinKhaiThacBklsSearch;
use common\models\searchs\RegHoSoXinKhaiThacSearch;
use common\models\searchs\RegHoSoXinKhaiThacTuanThuSearch;
use common\models\User;
use Yii;
use yii\web\NotFoundHttpException;

class DeNghiDuyetController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new RegHoSoXinKhaiThacSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_ho_so_xin_khai_thac.trang_thai_id'=>RegHoSoXinKhaiThac::TT_HOSO_DENGHIDUYET]);

        $nguoiKiemDuyet = User::find()->where(['id'=>Yii::$app->user->id])->one();
        if (Yii::$app->session->get('quyenHan')=='UBNDXA'){
            $dataProvider->query->andWhere(['in','reg_ho_so_xin_khai_thac.xa_phuong_id',explode(';',$nguoiKiemDuyet->sys_xa_phuong_id)]);
            $dataProvider->query->andWhere(['loai_hinh_chu_the_id'=>2]);
        }

        if(Yii::$app->session->get('quyenHan')=='UBNDHUYEN' || Yii::$app->session->get('quyenHan')=='HATKIEMLAM'){
            $dataProvider->query->andWhere(['in','reg_ho_so_xin_khai_thac.quan_huyen_id',explode(';',$nguoiKiemDuyet->sys_quan_huyen_id)]);
        }
        if(Yii::$app->session->get('quyenHan')=='CHICUCKIEMLAM') {
            $dataProvider->query->andWhere(['in','reg_ho_so_xin_khai_thac.tinh_thanh_id',explode(';',$nguoiKiemDuyet->sys_tinh_thanh_id)]);
        }

        return $this->render('index',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findHoSo($id);

        //Tìm toàn bộ thông tin chi tiết của Hồ sơ
        $searchBKLS = new RegHoSoXinKhaiThacBklsSearch();
        $dataBKLS = $searchBKLS->search(Yii::$app->request->queryParams);
        $dataBKLS->query->andWhere(['reg_ho_so_xin_khai_thac_id'=>$model->id]);

        //Tìm toàn bộ thông tin Trách nhiệm tuân thủ
        $searchTNTT = new RegHoSoXinKhaiThacTuanThuSearch();
        $dataTNTT = $searchTNTT->search(Yii::$app->request->queryParams);
        $dataTNTT->query->andWhere(['reg_ho_so_xin_khai_thac_id'=>$model->id]);


        return $this->render('view',[
           'model'=>$model,
            'searchBKLS'=>$searchBKLS,
            'dataBKLS'=>$dataBKLS,
            'searchTNTT'=>$searchTNTT,
            'dataTNTT'=>$dataTNTT,
        ]);
    }

    public function actionDuyetHoSo($id)
    {
        $model = $this->findHoSo($id);
        $model->trang_thai_id=RegHoSoXinKhaiThac::TT_HOSO_DUOCDUYET;
        $model->nguoi_duyet_id=Yii::$app->user->id;
        $model->ngay_duyet = date("Y-m-d H:i:s");
        $model->da_lap_ho_so_go = 0;
        if($model->ma==''||$model->ma==null){
            $model->ma=uniqid();
        }
        $modelBKLS = RegHoSoXinKhaiThacBkls::find()->where(['reg_ho_so_xin_khai_thac_id'=>$id])->all();
        foreach ($modelBKLS as $giaTri){
            $giaTri->trang_thai_id=RegHoSoXinKhaiThacBkls::TT_BKLS_DUOCDUYET;
            $giaTri->khoi_luong_da_dung = 0;
            $giaTri->save();
        }
        if($model->save()){
            Yii::$app->session->setFlash('success',Yii::t('backend','Xét duyệt hồ sơ đăng ký khai thác thành công'));
            return $this->redirect('index');
        } else {
            Yii::$app->session->setFlash('error',Yii::t('backend','Có lỗi trong quá trình xét duyệt, vui lòng kiểm tra lại'));
            return $this->redirect('index');
        }
    }

    public function actionKhongDuyet($id)
    {
        $model = new RegHoSoXnKhaiThacKhongDuyet();

        if($model->load(Yii::$app->request->post())){
            $model->reg_ho_so_xin_khai_thac_id = $id;
            $model->nguoi_lap=Yii::$app->user->id;
            $model->ngay_lap=date("Y-m-d H:i:s");
            if($model->save()){
                $modelHoSo = $this->findHoSo($id);
                $modelHoSo->trang_thai_id= RegHoSoXinKhaiThac::TT_HOSO_KHONGDUYET;
                $modelHoSo->nguoi_duyet_id = Yii::$app->user->id;
                $modelHoSo->ngay_duyet = date("Y-m-d H:i:s");
                $modelHoSo->save();
                Yii::$app->session->setFlash('success',Yii::t('backend','Không duyệt hồ sơ đăng ký thành công'));
                return $this->redirect(['view','id'=>$id]);
            } else {
                Yii::$app->session->setFlash('error',Yii::t('backend','Có lỗi trong quá trình duyệt, vui lòng kiểm tra lại'));
            }

        }
        return $this->renderAjax('khong-duyet-ho-so',[
            'model'=>$model
        ]);
    }

    public function actionViewFile($id,$fileName)
    {
        $model = $this->findHoSoTrachNhiemTuanThu($id);

        return $this->renderAjax('view-file',['fileName'=>$fileName]);
    }

    private function findHoSo($id)
    {
        if (($model = RegHoSoXinKhaiThac::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }

    private function findHoSoTrachNhiemTuanThu($id)
    {
        if (($model = RegHoSoXinKhaiThacTuanThu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }
}
