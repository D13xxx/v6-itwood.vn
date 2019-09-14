<?php

namespace backend\modules\DangKyKhaiThac\controllers;

use Yii;
use common\models\RegChuTheHoGiaDinh;
use common\models\RegChuTheToChuc;
use common\models\RegHoSoXinKhaiThac;
use common\models\searchs\RegHoSoXinKhaiThacBklsSearch;
use yii\web\NotFoundHttpException;

class InHoSoController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $model = $this->findModel($id);

        if($model->loai_hinh_chu_the_id==1){
            $modelChuThe = $this->findChuSoHuuToChuc($model->chu_the_id);
        } else {
            $modelChuThe = $this->findChuSoHuuHGD($model->chu_the_id);
        }

        //Tìm thông tin bảng kê lâm sản dự kiến thuộc hồ sơ xin khai thác
        $searchBKLS = new RegHoSoXinKhaiThacBklsSearch();
        $dataBKLS = $searchBKLS->search(Yii::$app->request->queryParams);
        $dataBKLS->query->andWhere(['reg_ho_so_xin_khai_thac_id'=>$model->id]);

        return $this->render('index', [
            'model' => $model,
            'dataBKLS'=>$dataBKLS,
            'modelChuThe'=>$modelChuThe,
        ]);

    }

    protected function findModel($id)
    {
        if (($model = RegHoSoXinKhaiThac::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
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
