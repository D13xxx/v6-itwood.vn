<?php

namespace backend\modules\QuanLyLoRung\controllers;

use common\models\RegChuTheHoGiaDinh;
use common\models\RegChuTheToChuc;
use common\models\RegLoRung;
use common\models\RegLoRungPhucTra;
use common\models\RegQuyenSuDungDat;
use common\models\searchs\RegLoRungSearch;
use common\models\User;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class PhucTraController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new RegLoRungSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_lo_rung.trang_thai_id'=>RegLoRung::TT_RUNGPHUCTRA]);

        $nguoiKiemDuyet = User::find()->where(['id'=>Yii::$app->user->id])->one();
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

        return $this->render('view',[
            'model'=>$model,
            'modelQSD'=>$modelQSD,
            'modelChuThe'=>$modelChuThe,
        ]);
    }

    public function actionDuyet($id)
    {
        $model = $this->findLoRung($id);
//        $model->rules(['tieu_khu','khoanh','lo'],'required');
//        $model->scenario = 'duyetPhucTra';
//        if($model->load(Yii::$app->request->post()) && $model->validate()){
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            if ($model->ngoai_ba_loai_rung == 0) {
                $model->scenario = 'duyetPhucTra';
            }
            if ($model->ngoai_ba_loai_rung == 1) {
                $model->scenario = 'duyetPhucTraNgoaiBaLoaiRung';
            }
        }

        if($model->load(Yii::$app->request->post())) {
            if($model->validate()){
                $maLoRungCu = $model->ma;
                $model->trang_thai_id=RegLoRung::TT_RUNGDUOCDUYET;
                $model->nguoi_duyet_id=Yii::$app->user->id;
                $model->ngay_duyet= date("Y-m-d H:i:s");
                $model->ma = $model->tieu_khu.'-'.$model->khoanh.'-'.$model->lo;
                $model->khong_co_dinh_danh=0;
                if($model->save()){
                    $modelPhucTra = new RegLoRungPhucTra();
                    $modelPhucTra->nguoi_tao=Yii::$app->user->id;
                    $modelPhucTra->ngay_tao = date("Y-m-d H:i:s");
                    $modelPhucTra->reg_lo_rung_ma_cu = $maLoRungCu;
                    $modelPhucTra->reg_lo_rung_ma_moi = $model->ma;
                    $modelPhucTra->reg_lo_rung_id = $model->id;
                    $modelPhucTra->save();
                    Yii::$app->session->setFlash('success',Yii::t('backend','Lô rừng đã được phê duyệt'));
                    return $this->redirect('index');
                } else {
                    Yii::$app->session->setFlash('error',Yii::t('backend','Không duyệt được lô rừng, kiểm tra lại dữ liệu'));
                    return $this->redirect(['view','id'=>$id]);
                }
            } else {
                Yii::$app->session->setFlash('error',Yii::t('backend','Có lỗi trong quá trình duyệt, vui lòng kiểm tra lại'));
                return $this->redirect(['view','id'=>$id]);
            }

        }

        return $this->renderAjax('duyet',[
            'model'=>$model,
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
