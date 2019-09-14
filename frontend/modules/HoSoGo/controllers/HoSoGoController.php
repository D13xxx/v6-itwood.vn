<?php

namespace frontend\modules\HoSoGo\controllers;

use common\models\RegChuTheHoGiaDinh;
use common\models\RegChuTheToChuc;
use common\models\RegHoSoGoChiTiet;
use common\models\RegHoSoGoChiTietTemp;
use common\models\RegHoSoXinKhaiThac;
use common\models\RegHoSoXinKhaiThacBkls;
use common\models\searchs\RegHoSoGoChiTietSearch;
use frontend\controllers\base\PController;
use Yii;
use common\models\RegHoSoGo;
use common\models\searchs\RegHoSoGoSearch;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HoSoGoController implements the CRUD actions for RegHoSoGo model.
 */
class HoSoGoController extends PController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RegHoSoGo models.
     * @return mixed
     */
//    public function actionIndex()
//    {
//        $searchModel = new RegHoSoGoSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }

    public function actionHoSoMoi()
    {
        $searchModel = new RegHoSoGoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')]);
        $dataProvider->query->andWhere(['or',['reg_ho_so_go.trang_thai_id'=>RegHoSoGo::TT_HSG_MOI],['reg_ho_so_go.trang_thai_id'=>RegHoSoGo::TT_HSG_DENGHIDUYET],['reg_ho_so_go.trang_thai_id'=>RegHoSoGo::TT_HSG_KHONGDUYET]]);
        $dataProvider->query->orderBy(['id'=>SORT_DESC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RegHoSoGo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $searchChiTiet = new RegHoSoGoChiTietSearch();
        $dataChiTiet = $searchChiTiet->search(Yii::$app->request->queryParams);
        $dataChiTiet->query->andWhere(['reg_ho_so_go_id'=>$model->id]);

        return $this->render('view', [
            'model' => $model,
            'dataChiTiet'=>$dataChiTiet,
        ]);
    }

    /**
     * Creates a new RegHoSoGo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RegHoSoGo();

        if($model->load(Yii::$app->request->post())){
            $model->ma=uniqid();
            $model->trang_thai_id=RegHoSoGo::TT_HSG_MOI;
            $model->reg_chu_the_id = Yii::$app->session->get('reg_chu_the_id');
            $model->reg_loai_hinh_chu_the = Yii::$app->session->get('reg_loai_chu_the_id');
            $model->ho_so_goc =1;
            if($model->save()){
                Yii::$app->session->setFlash('success',Yii::t('frontend','Thêm lô gỗ cho hô sơ gỗ mới tạo'));
                return $this->redirect(['update','id'=>$model->id]);
            }

        }

        return $this->render('create',['model'=>$model]);
    }

    /**
     * Updates an existing RegHoSoGo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $hoSoGoChiTiet = RegHoSoGoChiTietTemp::find()->where(['reg_ho_so_go_id'=>$model->id])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'hoSoGoChiTiet'=>$hoSoGoChiTiet
        ]);
    }

    /**
     * Deletes an existing RegHoSoGo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['ho-so-moi']);
    }

    /**
     * Finds the RegHoSoGo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RegHoSoGo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionThemLoGo($idHoSoGo)
    {
        $model = $this->findModel($idHoSoGo);

        $hoSoDangKyKT = RegHoSoXinKhaiThac::find()->where(['and',
            ['chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')],
            ['reg_ho_so_xin_khai_thac.trang_thai_id'=>RegHoSoXinKhaiThac::TT_HOSO_DUOCDUYET],
            ['quan_huyen_id'=>$model->quan_huyen_id]
        ])->all();
        $listHoSoDangKyKT = ArrayHelper::map($hoSoDangKyKT,'id',function ($data){
            return 'Mã hồ sơ đăng ký khai thác:'. $data->ma . ' - Ngày bắt đầu: '.date("d/m/Y",strtotime($data->ngay_bat_dau));
        });

        return $this->render('them-lo-go',[
            'listHoSoDangKyKhaiThac' => $listHoSoDangKyKT,
            'idHoSoGo'=>$idHoSoGo
        ]);

    }

    public function actionDanhSachLoRung($idHoSoXinKhaiThac,$idHoSoGo)
    {
        $query = RegHoSoXinKhaiThacBkls::find()->where([
            'and',
            ['reg_ho_so_xin_khai_thac_id'=>$idHoSoXinKhaiThac],
            ['<','khoi_luong_da_dung - (san_luong_du_kien * 0.1 + san_luong_du_kien)',0],
            ['trang_thai_id'=>RegHoSoXinKhaiThacBkls::TT_BKLS_DUOCDUYET]
        ]);
        $model=$query->all();

        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination'=>['pageSize' => 20,]
        ]);

        if(Yii::$app->request->post()){
            $selects= Yii::$app->request->post('selection');

            //B1. Kiểm tra dữ liệu xem đã chọn rừng hay chưa?
            // Nếu đã chọn kiểm tra các dữ liệu nhập vào
            //Nếu chưa chọn thông báo là chưa chọn
            if(!isset($selects))
            {
                Yii::$app->session->setFlash('error',Yii::t('frontend','Chưa chọn lô rừng khai thác'));
                return $this->redirect(['them-lo-go','idHoSoGo'=>$idHoSoGo]);
            }

            $tam=[];
            foreach ($selects as $key => $value){
                $duongKinhTB = Yii::$app->request->post('duong_kinh_trung_binh_'.$value);
                $chieuDai = Yii::$app->request->post('chieu_dai_'.$value);
                $soKhuc = Yii::$app->request->post('so_khuc_'.$value);
                $khoiLuong = Yii::$app->request->post('khoi_luong_'.$value);
                $modelBKLSXinKhaiThac = RegHoSoXinKhaiThacBkls::find()->where(['id'=>$value])->one();
                if($modelBKLSXinKhaiThac->khoi_luong_da_dung==''||$modelBKLSXinKhaiThac->khoi_luong_da_dung==null){
                    $khoiLuongDaDung = 0;
                } else {
                    $khoiLuongDaDung = $modelBKLSXinKhaiThac->khoi_luong_da_dung;
                }
                if($duongKinhTB==''||$duongKinhTB==null){
                    Yii::$app->session->setFlash('error',Yii::t('frontend','Đường kính trung bình không được để trống'));
                    return $this->redirect(['them-lo-go','idHoSoGo'=>$idHoSoGo]);
                } elseif(!is_numeric($duongKinhTB)){
                    Yii::$app->session->setFlash('error',Yii::t('frontend','Đường kính trung bình phải là số'));
                    return $this->redirect(['them-lo-go','idHoSoGo'=>$idHoSoGo]);
                } elseif($duongKinhTB <=0){
                    Yii::$app->session->setFlash('error',Yii::t('frontend','Đường kính trung bình phải lớn hơn 0'));
                    return $this->redirect(['them-lo-go','idHoSoGo'=>$idHoSoGo]);
                }
                if($chieuDai==''||$chieuDai==null){
                    Yii::$app->session->setFlash('error',Yii::t('frontend','Chiều dài khúc gỗ không được để trống'));
                    return $this->redirect(['them-lo-go','idHoSoGo'=>$idHoSoGo]);
                } elseif (!is_numeric($chieuDai)){
                    Yii::$app->session->setFlash('error',Yii::t('frontend','Chiều dài của khúc gỗ phải là số'));
                    return $this->redirect(['them-lo-go','idHoSoGo'=>$idHoSoGo]);
                } elseif ($chieuDai<=0){
                    Yii::$app->session->setFlash('error',Yii::t('frontend','Chiều dài của khúc gỗ phải lơn hơn 0'));
                    return $this->redirect(['them-lo-go','idHoSoGo'=>$idHoSoGo]);
                }
                if($khoiLuong==''||$khoiLuong==null){
                    Yii::$app->session->setFlash('error',Yii::t('frontend','Khối lượng không được để trống'));
                    return $this->redirect(['them-lo-go','idHoSoGo'=>$idHoSoGo]);
                } elseif (!is_numeric($khoiLuong)){
                    Yii::$app->session->setFlash('error',Yii::t('frontend','Khối lượng phải là số'));
                    return $this->redirect(['them-lo-go','idHoSoGo'=>$idHoSoGo]);
                } elseif ($khoiLuong <=0){
                    Yii::$app->session->setFlash('error',Yii::t('frontend','Khối lượng phải lớn hơn 0'));
                    return $this->redirect(['them-lo-go','idHoSoGo'=>$idHoSoGo]);
                }elseif ($khoiLuong> $modelBKLSXinKhaiThac->san_luong_du_kien+($modelBKLSXinKhaiThac->san_luong_du_kien*0.1)-$khoiLuongDaDung){
                    Yii::$app->session->setFlash('error',Yii::t('frontend','Khối lượng khai thác lớn hơn sản lượng còn lại vượt quá 10%, vui lòng nhập lại'));
                    return $this->redirect(['them-lo-go','idHoSoGo'=>$idHoSoGo]);
                }
                $tam[]=[
                    'idLoRung'=>$modelBKLSXinKhaiThac->reg_lo_rung_id,
                    'idHoSoXinKhaiThac'=>$modelBKLSXinKhaiThac->id,
                    'duongKinhTB'=>$duongKinhTB,
                    'chieuDai'=>$chieuDai,
                    'soKhuc'=>$soKhuc,
                    'khoiLuong'=>$khoiLuong
                ];
            }

            //B2. Lưu dữ liệu vào bảng dữ liệu
            //Điền vào bảng xin khai thác phần số lượng
            $idsHoSoGoChiTiet=[];
            foreach ($tam as $item){
                $modelChiTiet = new RegHoSoGoChiTietTemp();
                $modelChiTiet->reg_lo_rung_id=$item['idLoRung'];
                $modelChiTiet->cap_duong_kinh_trung_binh=$item['duongKinhTB'];
                $modelChiTiet->chieu_dai=$item['chieuDai'];
                $modelChiTiet->so_luong=$item['soKhuc'];
                $modelChiTiet->khoi_luong=$item['khoiLuong'];
                $modelChiTiet->reg_ho_so_xin_khai_thac_id = $item['idHoSoXinKhaiThac'];
                $modelChiTiet->reg_ho_so_go_id=$idHoSoGo;
                $modelChiTiet->save();
                $bklsXinKhaiThac = RegHoSoXinKhaiThacBkls::find()->where(['id'=>$item['idHoSoXinKhaiThac']])->one();
                $khoiLuongDaDungHienCo = $bklsXinKhaiThac->khoi_luong_da_dung;
                if($khoiLuongDaDungHienCo+$item['khoiLuong']-$bklsXinKhaiThac->san_luong_du_kien >= 0 ){
                    $bklsXinKhaiThac->khoi_luong_da_dung = $khoiLuongDaDungHienCo + $item['khoiLuong'];
                    $bklsXinKhaiThac->trang_thai_id=RegHoSoXinKhaiThacBkls::TT_BKLS_DASUDUNGHET;
                } else {
                    $bklsXinKhaiThac->khoi_luong_da_dung = $khoiLuongDaDungHienCo + $item['khoiLuong'];
                }

                $bklsXinKhaiThac->save();
                $hoSoDangKyKhaiThac = $this->findHoSoDangKyKhaiThac($bklsXinKhaiThac->reg_ho_so_xin_khai_thac_id);
                $hoSoDangKyKhaiThac->da_lap_ho_so_go =1;
                $hoSoDangKyKhaiThac->save();
//                $idsHoSoGoChiTiet[] =$modelChiTiet->id;
            }
            $idHoSoGoChiTiet = implode('_',$idsHoSoGoChiTiet);
            if($_POST['luuThongTin']  == 'create'){
                Yii::$app->session->setFlash('success',Yii::t('frontend','Thêm mới thành công'));
                return $this->redirect(['update','id'=>$idHoSoGo]);
            }
            if($_POST['luuThongTin']=='create_new'){
                Yii::$app->session->setFlash('success',Yii::t('frontend','Thêm mới thành công'));
                return $this->redirect(['them-lo-go','idHoSoGo'=>$idHoSoGo]);
            }
        }

        return $this->renderAjax('danh-sach-lo-rung',[
            'models'=>$model,
            'dataProvider'=>$dataProvider,
            'idHoSoGo'=>$idHoSoGo,
        ]);
    }

    protected function findHoSoDangKyKhaiThac($id)
    {
        if(($model = RegHoSoXinKhaiThac::findOne($id))!==null){
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend','Không tìm thấy hồ sơ đăng ký khai thác'));
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

    protected function findModelChiTiet($id)
    {
        if (($model = RegHoSoGoChiTietTemp::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'Không tìm thấy hồ sơ gỗ nào.'));
    }

    public function actionXoaThongTin($id)
    {
        $model = $this->findModelChiTiet($id);
        $khoiLuongHoanLai = $model->khoi_luong;
        $idHoSoDangKyKhaiThac = $model->reg_ho_so_xin_khai_thac_id;

        $bklsXinKhaiThac = RegHoSoXinKhaiThacBkls::find()->where(['id'=>$model->reg_ho_so_xin_khai_thac_id])->one();
        $bklsXinKhaiThac->khoi_luong_da_dung = $bklsXinKhaiThac->khoi_luong_da_dung-$khoiLuongHoanLai;
        $bklsXinKhaiThac->trang_thai_id = RegHoSoXinKhaiThacBkls::TT_BKLS_DUOCDUYET;
        $model->delete();
        $bklsXinKhaiThac->save();
        $countBangKe = RegHoSoGoChiTietTemp::find()->where(['reg_ho_so_xin_khai_thac_id'=>$idHoSoDangKyKhaiThac])->count();
        if($countBangKe <=0){
            $hoSoDangKyKhaiThac = $this->findHoSoDangKyKhaiThac($idHoSoDangKyKhaiThac);
            $hoSoDangKyKhaiThac->da_lap_ho_so_go =0;
            $hoSoDangKyKhaiThac->save();
        }
//        print_r($idsHoSoMoi);
//        exit();
        return $this->redirect(['update','id'=>$model->reg_ho_so_go_id]);

    }

    public function actionDeNghiDuyet($idHoSoGo)
    {
        $model = $this->findModel($idHoSoGo);
        $modelChiTiets = RegHoSoGoChiTietTemp::find()->where(['reg_ho_so_go_id'=>$idHoSoGo])->all();
        foreach ($modelChiTiets as $modelChiTiet)
        {
            $modelChiTietHoSoGo = new RegHoSoGoChiTiet();
            $dataHoSoGo = $modelChiTiet->attributes;
            $modelChiTietHoSoGo->setAttributes($dataHoSoGo);
            $modelChiTietHoSoGo->reg_chu_the_id=Yii::$app->session->get('reg_chu_the_id');
            $modelChiTietHoSoGo->loai_chu_the_id = Yii::$app->session->get('reg_loai_chu_the_id');
            $modelChiTietHoSoGo->khoi_luong_da_dung =0;
            $modelChiTietHoSoGo->trang_thai_id=2;
            $modelChiTietHoSoGo->save();
            $modelChiTiet->delete();
        }
        $model->trang_thai_id=RegHoSoGo::TT_HSG_DENGHIDUYET;
        $model->ngay_lap=date("Y-m-d H:i:s");
        $model->save();
        return $this->redirect('ho-so-moi');
    }

    public function actionHoSoDaDuyet()
    {
        $searchModel = new RegHoSoGoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')]);
        $dataProvider->query->andWhere(['reg_loai_hinh_chu_the'=>Yii::$app->session->get('reg_loai_chu_the_id')]);
        $dataProvider->query->andWhere(['reg_ho_so_go.trang_thai_id'=>RegHoSoGo::TT_HSG_DUOCDUYET]);
        $dataProvider->query->orderBy(['id'=>SORT_DESC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionQuayLai($id)
    {
        $model = $this->findModel($id);
        $countTemp = RegHoSoGoChiTietTemp::find()->where(['reg_ho_so_go_id'=>$model->id])->count();
        if($countTemp <= 0){
            $countChiTiet = RegHoSoGoChiTiet::find()->where(['reg_ho_so_go_id'=>$model->id])->count();
            if($countChiTiet <=0){
                $model->delete();
            }
        }
        return $this->redirect('ho-so-moi');
    }
}
