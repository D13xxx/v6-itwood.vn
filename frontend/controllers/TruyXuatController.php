<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/28/2019
 * Time: 11:08 PM
 */

namespace frontend\controllers;

use common\models\RegChuTheHoGiaDinh;
use common\models\RegChuTheToChuc;
use common\models\RegHoSoGo;
use common\models\RegHoSoGoChiTiet;
use common\models\RegHoSoXinKhaiThac;
use common\models\RegLoRung;
use common\models\RegQuyenSuDungDat;
use common\models\searchs\RegHoSoXinKhaiThacBklsSearch;
use common\models\searchs\TruyXuatSearch;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TruyXuatController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new TruyXuatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if($searchModel->ma !='' || $searchModel->ma !=null){
            $maTimKiem = $searchModel->ma;
        } else {
            $maTimKiem='';
        }

        return $this->render('index',[
            'data'=>$dataProvider,
            'searchModel'=>$searchModel,
            'maTimKiem'=>$maTimKiem,
        ]);
    }

    public function actionViewHoGiaDinh($id)
    {
        $model = $this->findHoGiaDinh($id);

        return $this->render('view-ho-gia-dinh',[
            'model'=>$model,
        ]);
    }

    protected function findHoGiaDinh($id)
    {
        if(($model=RegChuTheHoGiaDinh::findOne($id))!==null){
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend','Không tìm thấy hộ gia đình này'));
    }

    public function actionViewToChuc($id)
    {
        $model = $this->findToChuc($id);

        return $this->render('view-to-chuc',[
            'model'=>$model,
        ]);
    }

    protected function findToChuc($id)
    {
        if(($model=RegChuTheToChuc::findOne($id))!==null){
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend','Không tìm thấy hộ gia đình này'));
    }

    public function actionViewLoRung($id)
    {
        $model = $this->findLoRung($id);
        $modelQSD = $this->findQSDDat($model->quyen_sdd_id);
        if($modelQSD->loai_chu_the_id==1){
            $modelChuThe = $this->findToChuc($model->chu_the_id);
        } else {
            $modelChuThe = $this->findHoGiaDinh($model->chu_the_id);
        }

        return $this->render('view-lo-rung',[
            'modelChuThe'=>$modelChuThe,
            'modelQSD'=>$modelQSD,
            'modelLoRung'=>$model,
        ]);
    }

    protected function findLoRung($id)
    {
        if (($model = RegLoRung::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('backend', 'Không tìm thấy lô rừng.'));
    }
    protected function findQSDDat($id)
    {
        if (($model = RegQuyenSuDungDat::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('backend', 'Không tìm thấy quyền sử dụng đất.'));
    }

    public function actionViewDangKyKhaiThac($id)
    {
        $model = $this->findHoSoXinKhaiThac($id);

        if($model->loai_hinh_chu_the_id==1){
            $modelChuThe = $this->findToChuc($model->chu_the_id);
        } else {
            $modelChuThe = $this->findHoGiaDinh($model->chu_the_id);
        }

        //Tìm thông tin bảng kê lâm sản dự kiến thuộc hồ sơ xin khai thác
        $searchBKLS = new RegHoSoXinKhaiThacBklsSearch();
        $dataBKLS = $searchBKLS->search(Yii::$app->request->queryParams);
        $dataBKLS->query->andWhere(['reg_ho_so_xin_khai_thac_id'=>$model->id]);

        return $this->render('view-dang-ky-khai-thac', [
            'model' => $model,
            'dataBKLS'=>$dataBKLS,
            'modelChuThe'=>$modelChuThe,
        ]);
    }

    protected function findHoSoXinKhaiThac($id)
    {
        if (($model = RegHoSoXinKhaiThac::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'Không tìm thấy hồ sơ đăng ký khai thác.'));
    }

    public function actionViewHoSoGo($id)
    {
        $model = $this->findHoSoGo($id);

        $modelUser = User::find()->where(['reg_chu_the_id'=>$model->reg_chu_the_id])->one();

        if($modelUser->loai_chu_the_id==1){
            $modelChuThe = $this->findToChuc($model->reg_chu_the_id);
        } else {
            $modelChuThe = $this->findHoGiaDinh($model->reg_chu_the_id);
        }

        $dataChiTiet = RegHoSoGoChiTiet::find()->where(['reg_ho_so_go_id'=>$model->id])->orderBy(['reg_ho_so_xin_khai_thac_id'=>SORT_ASC])->all();

        return $this->render('view-ho-so-go', [
            'model' => $model,
            'dataChiTiet'=>$dataChiTiet,
            'modelUser'=>$modelUser,
            'modelChuThe'=>$modelChuThe
        ]);
    }

    protected function findHoSoGo($id)
    {
        if (($model = RegHoSoGo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'Không tìm thấy hồ sơ gỗ nào.'));
    }

}