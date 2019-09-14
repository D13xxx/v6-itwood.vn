<?php

namespace frontend\modules\GiaoDich\controllers;

use common\models\RegChuTheHoGiaDinh;
use common\models\RegChuTheToChuc;
use common\models\RegHoSoGo;
use common\models\RegHoSoGoChiTiet;
use common\models\RegHoSoGoGiaoDich;
use common\models\RegHoSoXinKhaiThac;
use common\models\RegHoSoXinKhaiThacBkls;
use common\models\searchs\RegChuTheHoGiaDinhSearch;
use common\models\searchs\RegChuTheToChucSearch;
use common\models\searchs\RegHoSoGoChiTietSearch;
use common\models\searchs\RegHoSoGoSearch;
use common\models\searchs\RegHoSoXinKhaiThacBklsSearch;
use common\models\searchs\RegHoSoXinKhaiThacSearch;
use common\models\User;
use frontend\controllers\base\PController;
use Yii;
use common\models\RegHoSoXinKhaiThacGiaoDich;
use common\models\searchs\RegHoSoXinKhaiThacGiaoDichSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GiaoDichController implements the CRUD actions for RegHoSoXinKhaiThacGiaoDich model.
 */
class GiaoDichController extends PController
{

    public function actionBanRung()
    {
        $search= new RegHoSoXinKhaiThacSearch();
        $dataProvider = $search->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_ho_so_xin_khai_thac.trang_thai_id'=>RegHoSoXinKhaiThac::TT_HOSO_DUOCDUYET]);
        $dataProvider->query->andWhere(['and',['chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')],['loai_hinh_chu_the_id'=>Yii::$app->session->get('reg_loai_chu_the_id')]]);
        $dataProvider->query->andWhere(['<>','da_lap_ho_so_go',1]);

        return $this->render('ban-rung',[
            'searchModel'=>$search,
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionXemHoSoDangKy($id)
    {
        $model = $this->findHoSoDangKy($id);
        $searchChiTiet = new RegHoSoXinKhaiThacBklsSearch();
        $dataProvider = $searchChiTiet->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_ho_so_xin_khai_thac_id'=>$model->id]);

        return $this->render('xem-ho-so-dang-ky',[
            'model'=>$model,
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionBanLoRung($id)
    {
        $model = $this->findHoSoDangKy($id);
        $searchChiTiet = new RegHoSoXinKhaiThacBklsSearch();
        $dataProvider = $searchChiTiet->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_ho_so_xin_khai_thac_id'=>$model->id]);

        return $this->render('ban-lo-rung',[
            'model'=>$model,
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionXemHoSoMua($id)
    {
        $model = $this->findHoSoDangKy($id);

        $modelGiaoDich = RegHoSoXinKhaiThacGiaoDich::find()->where(['reg_ho_so_xin_khai_thac_id'=>$model->id])->one();
        $modelUser = User::find()->where(['reg_chu_the_id'=>$modelGiaoDich->reg_chu_the_cu_id])->one();
        if($modelUser->loai_chu_the_id==1){
            $modelChuTheCu = RegChuTheToChuc::find()->where(['id'=>$modelUser->reg_chu_the_id])->one();
        } else {
            $modelChuTheCu = RegChuTheHoGiaDinh::find()->where(['id'=>$modelUser->reg_chu_the_id])->one();
        }

        $searchChiTiet = new RegHoSoXinKhaiThacBklsSearch();
        $dataProvider = $searchChiTiet->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_ho_so_xin_khai_thac_id'=>$model->id]);

        return $this->render('xem-ho-so-mua',[
            'model'=>$model,
            'dataProvider'=>$dataProvider,
            'modelUser'=>$modelUser,
            'modelChuTheCu'=>$modelChuTheCu,
        ]);
    }

//    public function action

    public function actionMuaRung()
    {
        $search= new RegHoSoXinKhaiThacSearch();
        $dataProvider = $search->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_ho_so_xin_khai_thac.trang_thai_id'=>RegHoSoXinKhaiThac::TT_HOSO_DACHUYENDOI]);
        $dataProvider->query->andWhere(['chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')]);

        return $this->render('mua-rung',[
            'searchModel'=>$search,
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionMuaLoRung($id)
    {
        $model = $this->findHoSoDangKy($id);
        $modelHoSoXinKhaiThac = RegHoSoXinKhaiThacGiaoDich::find()->where(['reg_ho_so_xin_khai_thac_id'=>$model->id])->one();

        $modelHoSoXinKhaiThac->loai_chu_the_id = Yii::$app->session->get('reg_loai_chu_the_id');
        $modelHoSoXinKhaiThac->ngay_mua = date("Y-m-d");
        $model->trang_thai_id = RegHoSoXinKhaiThac::TT_HOSO_DUOCDUYET;
        $model->save();
        $modelHoSoXinKhaiThac->save();
        Yii::$app->session->setFlash('success','Mua lô rừng thành công');
        return $this->redirect('mua-rung');
    }

    public function actionKhongMuaRung($id)
    {
        $model = $this->findHoSoDangKy($id);

        $modelHoSoXinKhaiThac = RegHoSoXinKhaiThacGiaoDich::find()->where(['reg_ho_so_xin_khai_thac_id'=>$model->id])->one();
        $model->trang_thai_id = RegHoSoXinKhaiThac::TT_HOSO_DUOCDUYET;
        $model->chu_the_id = $modelHoSoXinKhaiThac->reg_chu_the_cu_id;

        $model->save();
        $modelHoSoXinKhaiThac->delete();


        Yii::$app->session->setFlash('success','Không mua lô rừng thành công');
        return $this->redirect('mua-rung');
    }

    public function actionBanHoSoGo()
    {
        $search= new RegHoSoGoSearch();
        $dataProvider = $search->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['trang_thai_id'=>RegHoSoGo::TT_HSG_DUOCDUYET]);
        $dataProvider->query->andWhere(['reg_chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')]);

        return $this->render('ban-ho-so-go',[
            'searchModel'=>$search,
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionXemHoSoGo($id)
    {
        $model = $this->findHoSoGo($id);
        $searchChiTiet = new RegHoSoGoChiTietSearch();
        $dataProvider = $searchChiTiet->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_ho_so_go_id'=>$model->id]);

        return $this->render('xem-ho-so-go',[
            'model'=>$model,
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionBanLoGo($id)
    {
        $model = $this->findHoSoGo($id);
        $searchChiTiet = new RegHoSoGoChiTietSearch();
        $dataProvider = $searchChiTiet->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_ho_so_go_id'=>$model->id]);

        return $this->render('ban-lo-go',[
            'model'=>$model,
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionMuaHoSoGo()
    {
        $search= new RegHoSoGoSearch();
        $dataProvider = $search->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['trang_thai_id'=>RegHoSoGo::TT_HSG_CHUYENDOI]);
        $dataProvider->query->andWhere(['reg_chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')]);

        return $this->render('mua-ho-so-go',[
            'searchModel'=>$search,
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionXemHoSoGoMua($id)
    {
        $model = $this->findHoSoGo($id);

        $modelGiaoDich = RegHoSoGoGiaoDich::find()->where(['reg_ho_so_go_id'=>$model->id])->one();
        $modelUser = User::find()->where(['reg_chu_the_id'=>$modelGiaoDich->reg_chu_the_cu_id])->one();
        if($modelUser->loai_chu_the_id==1){
            $modelChuTheCu = RegChuTheToChuc::find()->where(['id'=>$modelUser->reg_chu_the_id])->one();
        } else {
            $modelChuTheCu = RegChuTheHoGiaDinh::find()->where(['id'=>$modelUser->reg_chu_the_id])->one();
        }

        $searchChiTiet = new RegHoSoGoChiTietSearch();
        $dataProvider = $searchChiTiet->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_ho_so_go_id'=>$model->id]);

        return $this->render('xem-ho-so-go-mua',[
            'model'=>$model,
            'dataProvider'=>$dataProvider,
            'modelUser'=>$modelUser,
            'modelChuTheCu'=>$modelChuTheCu,
        ]);
    }


    public function actionXacNhanMuaLoGo($id)
    {
        $model = $this->findHoSoGo($id);

        $modelHoSoGoGiaoDich = RegHoSoGoGiaoDich::find()->where(['reg_ho_so_go_id'=>$model->id])->one();

        $modelHoSoGoGiaoDich->loai_chu_the_id = Yii::$app->session->get('reg_loai_chu_the_id');
        $modelHoSoGoGiaoDich->ngay_mua = date("Y-m-d");

        $model->trang_thai_id = RegHoSoGo::TT_HSG_DUOCDUYET;
        $model->save();
        $modelHoSoGoGiaoDich->save();

        Yii::$app->session->setFlash('success','Mua lô gỗ thành công');
        return $this->redirect('mua-ho-so-go');
    }

    public function actionKhongMuaLoGo($id)
    {
        $model = $this->findHoSoGo($id);

        $modelHoSoGo = RegHoSoGoGiaoDich::find()->where(['reg_ho_so_go_id'=>$model->id])->one();

        $model->trang_thai_id = RegHoSoGo::TT_HSG_DUOCDUYET;
        $model->reg_chu_the_id = $modelHoSoGo->reg_chu_the_cu_id;
        $model->save();
        $modelHoSoGo->delete();
        Yii::$app->session->setFlash('success','Không mua lô gỗ thành công');
        return $this->redirect('mua-ho-so-go');
    }


    protected function findHoSoGo($id)
    {
        if(($model = RegHoSoGo::findOne($id))!== null){
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend','Không tìm thấy hồ sơ đăng ký khai thác'));
    }

    protected function findHoSoDangKy($id)
    {
        if(($model = RegHoSoXinKhaiThac::findOne($id))!== null){
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend','Không tìm thấy hồ sơ đăng ký khai thác'));
    }

    protected function findModel($id)
    {
        if (($model = RegHoSoXinKhaiThacGiaoDich::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'Không tìm thấy dữ liệu.'));
    }

    protected function findHoSoGoGiaoDich($id)
    {
        if (($model = RegHoSoGoGiaoDich::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'Không tìm thấy hồ sơ gỗ giao dịch.'));
    }

    public function actionGiaoDichHoSoGo($idLoaiChuThe,$idHoSo)
    {
        $model = new RegHoSoXinKhaiThacGiaoDich();

        if($model->load(Yii::$app->request->post())){
            if($model->ten_chu_the==''||$model->ten_chu_the==null){
                Yii::$app->session->setFlash('error','Tên chủ thể không được để trống');
                return $this->redirect(['ban-lo-rung','id'=>$idHoSo]);
            }
            if($idLoaiChuThe==1){
                if($model->ma_so_thue==''||$model->ma_so_thue==null){
                    Yii::$app->session->setFlash('error','Mã số thuế không được để trống');
                    return $this->redirect(['ban-lo-rung','id'=>$idHoSo]);
                }
            } else {
                if($model->so_cmtnd==''||$model->so_cmtnd==null){
                    Yii::$app->session->setFlash('error','Số CMTND không được để trống');
                    return $this->redirect(['ban-lo-rung','id'=>$idHoSo]);
                }
            }
            if($model->reg_chu_the_moi_id==''||$model->reg_chu_the_moi_id==null){
                $model->reg_chu_the_moi_id=0;
            }
            $model->reg_ho_so_xin_khai_thac_id=$idHoSo;
            $model->ngay_ban=date("Y-m-d");
            $model->reg_chu_the_cu_id = Yii::$app->session->get('reg_chu_the_id');
            $model->save();
            $modelHoSoDangKy = RegHoSoXinKhaiThac::find()->where(['id'=>$idHoSo])->one();
            $modelHoSoDangKy->trang_thai_id=RegHoSoXinKhaiThac::TT_HOSO_DACHUYENDOI;
            $modelHoSoDangKy->chu_the_id=$model->reg_chu_the_moi_id;
            $modelHoSoDangKy->save();

            Yii::$app->session->setFlash('success','Bán lô rừng thành công');
            return $this->redirect('ban-rung');
        }

        return $this->renderAjax('_form',[
            'model'=>$model,
            'idLoaiChuThe'=>$idLoaiChuThe
        ]);
    }

    public function actionGiaoDichLoGo($idLoaiChuThe,$idHoSo)
    {
        $model = new RegHoSoGoGiaoDich();

        if($model->load(Yii::$app->request->post())){
            if($model->ten_chu_the==''||$model->ten_chu_the==null){
                Yii::$app->session->setFlash('error','Tên chủ thể không được để trống');
                return $this->redirect(['ban-lo-go','id'=>$idHoSo]);
            }
            if($idLoaiChuThe==1){
                if($model->ma_so_thue==''||$model->ma_so_thue==null){
                    Yii::$app->session->setFlash('error','Mã số thuế không được để trống');
                    return $this->redirect(['ban-lo-go','id'=>$idHoSo]);
                }
            } else {
                if($model->so_cmtnd==''||$model->so_cmtnd==null){
                    Yii::$app->session->setFlash('error','Số CMTND không được để trống');
                    return $this->redirect(['ban-lo-go','id'=>$idHoSo]);
                }
            }
            if($model->reg_chu_the_moi_id==''||$model->reg_chu_the_moi_id==null){
                $model->reg_chu_the_moi_id=0;
            }
            $model->reg_ho_so_go_id=$idHoSo;
            $model->ngay_ban=date("Y-m-d");
            $model->reg_chu_the_cu_id = Yii::$app->session->get('reg_chu_the_id');
            $model->save();
            $modelHoSoGo = RegHoSoGo::find()->where(['id'=>$idHoSo])->one();
            $modelHoSoGo->trang_thai_id=RegHoSoGo::TT_HSG_CHUYENDOI;
//            $modelHoSoGo->giao
            $modelHoSoGo->reg_chu_the_id=$model->reg_chu_the_moi_id;
            $modelHoSoGo->save();

            Yii::$app->session->setFlash('success','Bán lô gỗ thành công');
            return $this->redirect('ban-rung');
        }

        return $this->renderAjax('_form_lo_go',[
            'model'=>$model,
            'idLoaiChuThe'=>$idLoaiChuThe
        ]);
    }

    public function actionChonNguoiMua($idLoaiChuThe)
    {
        $modelUser = User::find()->where(['id'=>Yii::$app->session->get('reg_user_id')])->one();
        $loaiChuTheDangDung = $modelUser->loai_chu_the_id;

        //Nếu Chủ thể đang dùng là Tổ chức thì trường tìm kiếm sẽ loại bò id của chủ thể tại bảng tổ chức

        if($idLoaiChuThe==1){
            $searchModel = new RegChuTheToChucSearch();
            $truongGiaTri='reg_chu_the_to_chuc.id';

        } else {
            $searchModel = new RegChuTheHoGiaDinhSearch();
            $truongGiaTri='reg_chu_the_ho_gia_dinh.id';
        }
        if($loaiChuTheDangDung==$idLoaiChuThe){
            $giaTriTimKiem = Yii::$app->session->get('reg_chu_the_id');
        } else {
            $giaTriTimKiem = 0;
        }
        $dataChuThe = $searchModel->search(Yii::$app->request->queryParams);
        $dataChuThe->query->andWhere(['trang_thai_id'=>1]);
        $dataChuThe->query->andFilterWhere(['<>',$truongGiaTri,$giaTriTimKiem]);

        return $this->renderAjax('chon-nguoi-mua',[
            'searchModel'=>$searchModel,
            'dataChuThe'=>$dataChuThe,
            'idLoaiChuThe'=>$idLoaiChuThe,
        ]);
    }
}
