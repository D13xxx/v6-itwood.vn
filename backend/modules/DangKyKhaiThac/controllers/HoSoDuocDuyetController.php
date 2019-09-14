<?php

namespace backend\modules\DangKyKhaiThac\controllers;
use common\models\RegHoSoXinKhaiThacTuanThu;
use common\models\searchs\RegHoSoXinKhaiThacBklsSearch;
use common\models\searchs\RegHoSoXinKhaiThacTuanThuSearch;
use common\models\User;
use Yii;

use common\models\searchs\RegHoSoXinKhaiThacSearch;
use common\models\RegHoSoXinKhaiThac;
use yii\web\NotFoundHttpException;

class HoSoDuocDuyetController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new RegHoSoXinKhaiThacSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_ho_so_xin_khai_thac.trang_thai_id'=>RegHoSoXinKhaiThac::TT_HOSO_DUOCDUYET]);

        $nguoiKiemDuyet = User::find()->where(['id'=>Yii::$app->user->id])->one();
        if (Yii::$app->session->get('quyenHan')=='UBNDXA'){
            $dataProvider->query->andWhere(['in','reg_ho_so_xin_khai_thac.xa_phuong_id',explode(';',$nguoiKiemDuyet->sys_xa_phuong_id)]);
            $dataProvider->query->andWhere(['loai_hinh_chu_the_id'=>2]);
        }

        if(Yii::$app->session->get('quyenHan')=='HATKIEMLAM'){
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
