<?php

namespace frontend\modules\HoSoGo\controllers;
use common\models\RegChuTheHoGiaDinh;
use common\models\RegChuTheToChuc;
use common\models\RegHoSoGo;
use common\models\RegHoSoGoChiTiet;
use common\models\RegLoRung;
use common\models\RegQuyenSuDungDat;
use common\models\searchs\RegHoSoGoChiTietSearch;
use common\models\searchs\RegLoRungSearch;
use common\models\User;
use frontend\controllers\base\PController;
use Yii;
use yii\web\NotFoundHttpException;

class InHoSoController extends PController
{
    public function actionIndex($id)
    {
        $model = $this->findModel($id);

        if($model->reg_loai_hinh_chu_the==1){
            $modelChuThe = $this->findToChu($model->reg_chu_the_id);
        } else {
            $modelChuThe = $this->findHoGiaDinh($model->reg_chu_the_id);
        }

        $modelUser = User::find()->where(['reg_chu_the_id'=>$model->reg_chu_the_id])->one();

        $dataChiTiet = RegHoSoGoChiTiet::find()->where(['reg_ho_so_go_id'=>$model->id])->orderBy(['reg_ho_so_xin_khai_thac_id'=>SORT_ASC])->all();

        return $this->render('index', [
            'model' => $model,
            'dataChiTiet'=>$dataChiTiet,
            'modelUser'=>$modelUser,
            'modelChuThe'=>$modelChuThe
        ]);
    }

    protected function findModel($id)
    {
        if (($model = RegHoSoGo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'Không tìm thấy hồ sơ gỗ nào.'));
    }

    private function findToChu($id)
    {
        if (($model = RegChuTheToChuc::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'Không tìm thấy tổ chức này.'));
    }

    private function findHoGiaDinh($id)
    {
        if (($model = RegChuTheHoGiaDinh::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'Không tìm thấy tổ chức này.'));
    }

}
