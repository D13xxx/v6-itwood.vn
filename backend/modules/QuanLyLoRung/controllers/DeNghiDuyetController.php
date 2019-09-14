<?php

namespace backend\modules\QuanLyLoRung\controllers;

use common\models\QuanHuyen;
use common\models\RegChuTheHoGiaDinh;
use common\models\RegChuTheToChuc;
use common\models\RegLoRung;
use common\models\RegQuyenSuDungDat;
use common\models\RegSystemFormis;
use common\models\searchs\RegLoRungSearch;
use common\models\TinhThanh;
use common\models\User;
use common\models\XaPhuong;
use Yii;
use yii\httpclient\Client;
use yii\web\NotFoundHttpException;

class DeNghiDuyetController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchLoRung = new RegLoRungSearch();
        $dataLoRung = $searchLoRung->search(Yii::$app->request->queryParams);
        $dataLoRung->query->andWhere(['reg_lo_rung.trang_thai_id'=>RegLoRung::TT_RUNGDENGHIDUYET]);

        $nguoiKiemDuyet = User::find()->where(['id'=>Yii::$app->user->id])->one();
        if (Yii::$app->session->get('quyenHan')=='UBNDXA'){
            $dataLoRung->query->andWhere(['loai_hinh_chu_the'=>2]);
            $dataLoRung->query->andWhere(['in','reg_lo_rung.xa_phuong_id',explode(';',$nguoiKiemDuyet->sys_xa_phuong_id)]);
        }

        if(Yii::$app->session->get('quyenHan')=='HATKIEMLAM'){
            $dataLoRung->query->andWhere(['in','reg_lo_rung.quan_huyen_id',explode(';',$nguoiKiemDuyet->sys_quan_huyen_id)]);
        }
        if(Yii::$app->session->get('quyenHan')=='CHICUCKIEMLAM') {
            $dataLoRung->query->andWhere(['in','reg_lo_rung.tinh_thanh_id',explode(';',$nguoiKiemDuyet->sys_tinh_thanh_id)]);
        }

        return $this->render('index',[
            'searchLoRung'=>$searchLoRung,
            'dataLoRung'=>$dataLoRung
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
        $model->trang_thai_id=RegLoRung::TT_RUNGDUOCDUYET;
        $model->nguoi_duyet_id=Yii::$app->user->id;
        $model->ngay_duyet= date("Y-m-d H:i:s");
        if($model->save()){
            Yii::$app->session->setFlash('success',Yii::t('backend','Lô rừng đã được phê duyệt'));
            return $this->redirect('index');
        } else {
            Yii::$app->session->setFlash('error',Yii::t('backend','Không duyệt được lô rừng, kiểm tra lại dữ liệu'));
        }
    }

    public function actionChuyenPhucTra($id)
    {
        $model = $this->findLoRung($id);
        $model->trang_thai_id = RegLoRung::TT_RUNGPHUCTRA;
        $model->nguoi_duyet_id=Yii::$app->user->id;
        $model->ngay_duyet= date("Y-m-d H:i:s");
        if($model->save()){
            Yii::$app->session->setFlash('success',Yii::t('backend','Đã chuyển lên để phúc tra'));
            return $this->redirect('index');
        } else {
            Yii::$app->session->setFlash('error',Yii::t('backend','Có lỗi, kiểm tra lại dữ liệu'));
        }
    }

    public function actionKiemTraFormis($id)
    {
        $model = $this->findLoRung($id);
        $maTinh = TinhThanh::find()->where(['id'=>$model->tinh_thanh_id])->one();
        $maQuan= QuanHuyen::find()->where(['id'=>$model->quan_huyen_id])->one();
        $maXa = XaPhuong::find()->where(['id'=>$model->xa_phuong_id])->one();
        $modelFormis = RegSystemFormis::find()->where(['and',['trang_thai_id'=>1],['id'=>1]])->one();
        $client = new Client();
        $url= $modelFormis->url.$modelFormis->bang_du_lieu."&maxFeatures=100&CQL_FILTER=matinh=".urlencode($maTinh->ma);
        $url.="%20AND%20mahuyen=".urlencode($maQuan->ma)."%20AND%20maxa=".urlencode($maXa->ma);
//        $url.="%20AND%20tieukhu=%27".$model->tieu_khu."%27%20AND%20khoanh=%27".$model->khoanh."%27%20AND%20malo=%27".$model->lo;
        $url.="%20AND%20tieukhu=%27".$model->tieu_khu."%27%20AND%20khoanh=%27".$model->khoanh."%27%20AND%20malo=%27".$model->lo;
        $url.="%27&outputFormat=application%2Fjson";
//        $url = "http://maps.vnforest.gov.vn:802/geoserver/download/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=download:dulieu2017&maxFeatures=100&CQL_FILTER=matinh=02%20AND%20mahuyen=024%20AND%20maxa=691%20AND%20tieukhu=%27135D%27%20AND%20khoanh=%273%27%20AND%20malo=%2783095%27&outputFormat=application%2Fjson";
        $res = $client->createRequest()->setMethod('POST')->setUrl($url)->send();
        if($res->isOk){
            $tam = $res->data;
            return $this->renderAjax('kiem-tra-formis',[
                'model'=>$tam,
            ]);
        } else {
            $tam=null;
            return $this->renderAjax('kiem-tra-formis',[
                'model'=>$tam,
            ]);
        }
    }

    public function actionKiemTraLoRung($id)
    {
        $model = $this->findLoRung($id);
        $maTinh = TinhThanh::find()->where(['id'=>$model->tinh_thanh_id])->one();
        $maQuan= QuanHuyen::find()->where(['id'=>$model->quan_huyen_id])->one();
        $maXa = XaPhuong::find()->where(['id'=>$model->xa_phuong_id])->one();
//        $modelFormis = RegSystemFormis::find()->where(['trang_thai_id'=>1])->one();
        $modelFormis = RegSystemFormis::find()->where(['and',['trang_thai_id'=>1],['id'=>4]])->one();
        $client = new Client();
        $url= $modelFormis->url.$modelFormis->bang_du_lieu."&maxFeatures=10&CQL_FILTER=matinh=".urlencode($maTinh->ma);
        $url.="%20AND%20mahuyen=".urlencode($maQuan->ma)."%20AND%20maxa=".urlencode($maXa->ma);
//        $url.="%20AND%20tieukhu=%27".$model->tieu_khu."%27%20AND%20khoanh=%27".$model->khoanh."%27%20AND%20malo=%27".$model->lo;
        $url.="%20AND%20tk=%27".$model->tieu_khu."%27%20AND%20khoanh=%27".$model->khoanh."%27%20AND%20lo=%27".$model->lo;
        $url.="%27&outputFormat=application%2Fjson";
//        $url = "http://maps.vnforest.gov.vn:802/geoserver/download/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=download:dulieu2017&maxFeatures=100&CQL_FILTER=matinh=02%20AND%20mahuyen=024%20AND%20maxa=691%20AND%20tieukhu=%27135D%27%20AND%20khoanh=%273%27%20AND%20malo=%2783095%27&outputFormat=application%2Fjson";
        $res = $client->createRequest()->setMethod('GET')->setUrl($url)->send();
        if($res->isOk){
            $tam = $res->data;
            return $this->renderAjax('kiem-tra-lo-rung',[
                'model'=>$tam,
            ]);
        } else {
            $tam=null;
            return $this->renderAjax('kiem-tra-lo-rung',[
                'model'=>$tam,
            ]);
        }
    }

    private function findLoRung($id)
    {
        if (($model = RegLoRung::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('backend', 'Không tìm thấy lô rừng.'));
    }

    private function findQSDDat($id)
    {
        if (($model = RegQuyenSuDungDat::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('backend', 'Không tìm thấy QSD Đất.'));
    }
    private function findChuSoHuuHGD($id)
    {
        if (($model = RegChuTheHoGiaDinh::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('backend', 'Không tìm thấy Hộ gia đình.'));
    }
    private function findChuSoHuuToChuc($id)
    {
        if (($model = RegChuTheToChuc::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('backend', 'Không tìm thấy Tổ chức.'));
    }

    public function actionViewFile($id,$fileName)
    {
        $model = $this->findQSDDat($id);

        return $this->renderAjax('view-file',['fileName'=>$fileName]);
    }
}
