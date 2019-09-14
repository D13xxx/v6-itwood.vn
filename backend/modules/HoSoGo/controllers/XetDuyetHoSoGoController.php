<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/26/2019
 * Time: 3:10 PM
 */
namespace backend\modules\HoSoGo\controllers;

use common\models\RegHoSoGo;
use common\models\RegHoSoGoChiTiet;
use common\models\RegHoSoGoKhongDuyet;
use common\models\RegHoSoXinKhaiThacBkls;
use common\models\searchs\RegHoSoGoChiTietSearch;
use common\models\searchs\RegHoSoGoSearch;
use common\models\searchs\RegHoSoXinKhaiThacBklsSearch;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class XetDuyetHoSoGoController extends Controller
{
    public function actionIndex()
    {
        $search = new RegHoSoGoSearch();
        $dataProvider = $search->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_ho_so_go.trang_thai_id'=>RegHoSoGo::TT_HSG_DENGHIDUYET]);

        $nguoiKiemDuyet = User::find()->where(['id'=>Yii::$app->user->id])->one();
        if(Yii::$app->session->get('quyenHan')=='HATKIEMLAM'){
            $dataProvider->query->andWhere(['in','quan_huyen_id',explode(';',$nguoiKiemDuyet->sys_quan_huyen_id)]);
        }
        if(Yii::$app->session->get('quyenHan')=='CHICUCKIEMLAM') {
            $dataProvider->query->andWhere(['in','tinh_thanh_id',explode(';',$nguoiKiemDuyet->sys_tinh_thanh_id)]);
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

    public function actionDuyetHoSo($id)
    {
        $model = $this->findHoSoGo($id);
        $model->trang_thai_id = RegHoSoGo::TT_HSG_DUOCDUYET;
        $model->nguoi_duyet=Yii::$app->user->id;
        $model->ngay_duyet=date("Y-m-d H:i:s");

        $modelChiTiets = RegHoSoGoChiTiet::find()->where(['reg_ho_so_go_id'=>$model->id])->all();
        foreach ($modelChiTiets as $modelChiTiet){
            $modelChiTiet->trang_thai_id = 3;
            $modelChiTiet->save();
        }
        $model->save();
        return $this->redirect('index');
    }

    public function actionKhongDuyetHoSo($id)
    {
        $model = new RegHoSoGoKhongDuyet();

        if($model->load(Yii::$app->request->post())){
            $model->reg_ho_so_go_id = $id;
            $model->nguoi_lap=Yii::$app->user->id;
            $model->ngay_lap=date("Y-m-d H:i:s");
            if($model->save()){
                $modelHoSoGo = $this->findHoSoGo($id);
                $modelHoSoGo->trang_thai_id= RegHoSoGo::TT_HSG_KHONGDUYET;
                $modelHoSoGo->nguoi_duyet = Yii::$app->user->id;
                $modelHoSoGo->ngay_duyet = date("Y-m-d H:i:s");
                $modelHoSoGo->save();
                Yii::$app->session->setFlash('success',Yii::t('backend','Không duyệt hồ sơ gỗ thành công'));
                return $this->redirect(['view','id'=>$id]);
            } else {
                Yii::$app->session->setFlash('error',Yii::t('backend','Có lỗi trong quá trình duyệt, vui lòng kiểm tra lại'));
            }

        }
        return $this->renderAjax('khong-duyet-ho-so',[
            'model'=>$model
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