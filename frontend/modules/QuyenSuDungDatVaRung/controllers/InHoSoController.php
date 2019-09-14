<?php

namespace frontend\modules\QuyenSuDungDatVaRung\controllers;
use common\models\RegChuTheHoGiaDinh;
use common\models\RegChuTheToChuc;
use common\models\RegLoRung;
use common\models\RegQuyenSuDungDat;
use common\models\searchs\RegLoRungSearch;
use frontend\controllers\base\PController;
use Yii;
use yii\web\NotFoundHttpException;

class InHoSoController extends PController
{
    public function actionQuyenSuDungDat($id)
    {
        $model = $this->findQSDDat($id);
        if($model->loai_chu_the_id==1){
            $modelChuThe = $this->findChuSoHuuToChuc($model->chu_the_id);
        } else {
            $modelChuThe = $this->findChuSoHuuHGD($model->chu_the_id);
        }
        $searchLoRung = new RegLoRungSearch();
        $dataLoRung = $searchLoRung->search(Yii::$app->request->queryParams);
        $dataLoRung->query->andWhere(['and',['reg_lo_rung.quyen_sdd_id'=>$id],['reg_lo_rung.chu_the_id'=>$modelChuThe->id]]);

        return $this->render('quyen-su-dung-dat',[
            'modelQSD'=>$model,
            'modelChuThe'=>$modelChuThe,
            'searchModel'=>$searchLoRung,
            'dataLoRung'=>$dataLoRung,
        ]);
    }

    public function actionLoRung($id){
        $model = $this->findLoRung($id);
        $modelQSD = $this->findQSDDat($model->quyen_sdd_id);
        if($modelQSD->loai_chu_the_id==1){
            $modelChuThe = $this->findChuSoHuuToChuc($model->chu_the_id);
        } else {
            $modelChuThe = $this->findChuSoHuuHGD($model->chu_the_id);
        }

        return $this->render('lo-rung',[
            'modelChuThe'=>$modelChuThe,
            'modelQSD'=>$modelQSD,
            'modelLoRung'=>$model,
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
