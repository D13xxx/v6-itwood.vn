<?php

namespace backend\modules\ChuThe\controllers;

use common\models\RegChuTheHoGiaDinh;
use common\models\RegChuTheToChuc;
use Yii;
use yii\web\NotFoundHttpException;

class InHoSoController extends \yii\web\Controller
{
    public function actionIndex($id,$loaiChuThe)
    {
        if($loaiChuThe==1){
            $model = $this->findChuSoHuuToChuc($id);
        } else {
            $model = $this->findChuSoHuuHGD($id);
        }

        return $this->render('index',[
            'model'=>$model,
            'loaiChuTheID'=>$loaiChuThe
        ]);
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
