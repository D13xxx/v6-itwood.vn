<?php

namespace backend\modules\QuanLyLoRung\controllers;

use common\models\RegChuTheHoGiaDinh;
use common\models\RegChuTheToChuc;
use common\models\RegLoRung;
use common\models\RegQuyenSuDungDat;
use common\models\searchs\RegLoRungKhongDuyetSearch;
use common\models\searchs\RegLoRungSearch;
use common\models\User;
use Yii;
use yii\web\NotFoundHttpException;

class LoRungKhongDuyetController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new RegLoRungSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_lo_rung.trang_thai_id'=>RegLoRung::TT_RUNGKHONGDUOCDUYET]);

        $nguoiKiemDuyet = User::find()->where(['id'=>Yii::$app->user->id])->one();
        if (Yii::$app->session->get('quyenHan')=='UBNDXA'){
            $dataProvider->query->andWhere(['loai_hinh_chu_the'=>2]);
            $dataProvider->query->andWhere(['in','reg_lo_rung.xa_phuong_id',explode(';',$nguoiKiemDuyet->sys_xa_phuong_id)]);
        }

        if(Yii::$app->session->get('quyenHan')=='HATKIEMLAM'){
            $dataProvider->query->andWhere(['in','reg_lo_rung.quan_huyen_id',explode(';',$nguoiKiemDuyet->sys_quan_huyen_id)]);
        }
        if(Yii::$app->session->get('quyenHan')=='CHICUCKIEMLAM') {
            $dataProvider->query->andWhere(['in','reg_lo_rung.tinh_thanh_id',explode(';',$nguoiKiemDuyet->sys_tinh_thanh_id)]);
        }

        return $this->render('index',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findLoRung($id);
        $modelQSD = $this->findQSDDat($model->quyen_sdd_id);

        if($modelQSD->loai_chu_the_id==1){
            $modelChuThe = $this->findChuSoHuuToChuc($modelQSD->chu_the_id);
        } else {
            $modelChuThe = $this->findChuSoHuuHGD($modelQSD->chu_the_id);
        }

        $searchModel = new RegLoRungKhongDuyetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view',[
            'model'=>$model,
            'modelQSD'=>$modelQSD,
            'modelChuThe'=>$modelChuThe,
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
        ]);
    }

    private function findLoRung($id)
    {
        if (($model = RegLoRung::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }

    private function findQSDDat($id)
    {
        if (($model = RegQuyenSuDungDat::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }

    private function findChuSoHuuHGD($id)
    {
        if (($model = RegChuTheHoGiaDinh::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }

    private function findChuSoHuuToChuc($id)
    {
        if (($model = RegChuTheToChuc::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }

    public function actionViewFile($id,$fileName)
    {
        $model = $this->findQSDDat($id);

        return $this->renderAjax('view-file',['fileName'=>$fileName]);
    }
}
