<?php

namespace backend\modules\QuanLyLoRung\controllers;

use common\models\RegChuTheHoGiaDinh;
use common\models\RegChuTheToChuc;
use common\models\RegLoRung;
use common\models\RegQuyenSuDungDat;
use Yii;
use yii\web\NotFoundHttpException;

class InHoSoController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $model = $this->findLoRung($id);
        $modelQSD = $this->findQSDDat($model->quyen_sdd_id);
        if($modelQSD->loai_chu_the_id==1){
            $modelChuThe = $this->findChuSoHuuToChuc($modelQSD->chu_the_id);
        } else {
            $modelChuThe = $this->findChuSoHuuHGD($modelQSD->chu_the_id);
        }

        return $this->render('index',[
            'modelLoRung'=>$model,
            'modelChuThe'=>$modelChuThe,
            'modelQSD'=>$modelQSD,
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
}
