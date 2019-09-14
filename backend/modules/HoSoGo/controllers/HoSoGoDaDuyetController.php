<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/28/2019
 * Time: 9:06 AM
 */

namespace backend\modules\HoSoGo\controllers;

use common\models\RegHoSoGo;
use common\models\RegHoSoGoChiTiet;
use common\models\searchs\RegHoSoGoChiTietSearch;
use common\models\searchs\RegHoSoGoSearch;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class HoSoGoDaDuyetController extends Controller
{

    public function actionIndex()
    {
        $search = new RegHoSoGoSearch();
        $dataProvider = $search->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_ho_so_go.trang_thai_id'=>RegHoSoGo::TT_HSG_DUOCDUYET]);

        $nguoiKiemDuyet = User::find()->where(['id'=>Yii::$app->user->id])->one();
        if(Yii::$app->session->get('quyenHan')=='HATKIEMLAM'){
            $dataProvider->query->andWhere(['in','reg_ho_so_go.quan_huyen_id',explode(';',$nguoiKiemDuyet->sys_quan_huyen_id)]);
        }
        if(Yii::$app->session->get('quyenHan')=='CHICUCKIEMLAM') {
            $dataProvider->query->andWhere(['in','reg_ho_so_go.tinh_thanh_id',explode(';',$nguoiKiemDuyet->sys_tinh_thanh_id)]);
        }

        return $this->render('index',[
            'searchModel'=>$search,
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findHoSoGo($id);
        $searchChiTiet = new RegHoSoGoChiTietSearch();
        $dataChiTiet = $searchChiTiet->search(Yii::$app->request->queryParams);
        $dataChiTiet->query->andWhere(['reg_ho_so_go_id'=>$model->id]);

        //Thông tin đăng ký khai thác
        $bklsXinKhaiThac = RegHoSoGoChiTiet::find()->where(['reg_ho_so_go_id'=>$model->id]);
        $bklsXinKhaiThac->groupBy(['reg_ho_so_xin_khai_thac_id']);
        $dataKhaiThac = new ActiveDataProvider([
            'query'=>$bklsXinKhaiThac,
            'pagination'=>['pageSize' => 20,]
        ]);

        return $this->render('view',[
            'model'=>$model,
            'searchChiTiet'=>$searchChiTiet,
            'dataChiTiet'=>$dataChiTiet,
            'dataKhaiThac'=>$dataKhaiThac
        ]);
    }

    private function findHoSoGo($id)
    {
        if(($model=RegHoSoGo::findOne($id))!=null){
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend','Không tìm thấy hồ sơ gỗ'));
    }

}