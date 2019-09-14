<?php

namespace backend\modules\QuanLyLoRung\controllers;

use common\models\RegLoRung;
use common\models\RegLoRungKhongDuyet;
use common\models\RegQuyenSuDungDat;
use Yii;
use yii\web\NotFoundHttpException;

class KhongDuyetLoRungController extends \yii\web\Controller
{
    public function actionKhongDuyet($id)
    {
        $model = $this->findLoRung($id);
        $modelKhongDuyet = new RegLoRungKhongDuyet();

        if($modelKhongDuyet->load(Yii::$app->request->post())){
            $modelKhongDuyet->nguoi_lap= Yii::$app->user->id;
            $modelKhongDuyet->ngay_lap=date("Y-m-d H:i:s");
            $modelKhongDuyet->reg_lo_rung_id = $id;
            if($modelKhongDuyet->save()){
                $model->trang_thai_id = RegLoRung::TT_RUNGKHONGDUOCDUYET;
                $model->nguoi_duyet_id = Yii::$app->user->id;
                $model->ngay_duyet = date("Y-m-d H:i:s");
                $model->save();
                Yii::$app->session->setFlash('success',Yii::t('backend','Không duyệt lô rừng thành công'));
                return $this->redirect('/quan-ly-lo-rung/de-nghi-duyet/index');
            }
        }

        return $this->renderAjax('index',[
            'model'=>$modelKhongDuyet
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
        throw new NotFoundHttpException(Yii::t('backend', 'Không tìm thấy QSD Đất.'));
    }

    public function actionViewFile($id,$fileName)
    {
        $model = $this->findQSDDat($id);

        return $this->renderAjax('view-file',['fileName'=>$fileName]);
    }
}
