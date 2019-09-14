<?php

namespace frontend\modules\HoSoXinKhaiThac\controllers;

use common\models\Dungchung;
use common\models\RegHoSoXinKhaiThacBkls;
use common\models\RegLoRung;
use common\models\searchs\RegHoSoXinKhaiThacBklsSearch;
use common\models\searchs\RegHoSoXinKhaiThacTrongRungSearch;
use common\models\searchs\RegHoSoXnKhaiThacKhongDuyetSearch;
use frontend\controllers\base\PController;
use Yii;
use common\models\RegHoSoXinKhaiThac;
use common\models\searchs\RegHoSoXinKhaiThacSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HoSoXinKhaiThacController implements the CRUD actions for RegHoSoXinKhaiThac model.
 */
class HoSoXinKhaiThacController extends PController
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
     * Lists all RegHoSoXinKhaiThac models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RegHoSoXinKhaiThacSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')]);
        $dataProvider->query->andWhere(['<>','reg_ho_so_xin_khai_thac.trang_thai_id',RegHoSoXinKhaiThac::TT_HOSO_DACHUYENDOI]);
        $dataProvider->query->andWhere(['<>','reg_ho_so_xin_khai_thac.trang_thai_id',RegHoSoXinKhaiThac::TT_HOSO_DUOCDUYET]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDaDuyet()
    {
        $searchModel = new RegHoSoXinKhaiThacSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')]);
        $dataProvider->query->andWhere(['reg_ho_so_xin_khai_thac.trang_thai_id'=>RegHoSoXinKhaiThac::TT_HOSO_DUOCDUYET]);

        return $this->render('da-duyet', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single RegHoSoXinKhaiThac model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        //Tìm thông tin bảng kê lâm sản dự kiến thuộc hồ sơ xin khai thác
        $searchBKLS = new RegHoSoXinKhaiThacBklsSearch();
        $dataBKLS = $searchBKLS->search(Yii::$app->request->queryParams);
        $dataBKLS->query->andWhere(['reg_ho_so_xin_khai_thac_id'=>$model->id]);

        //Tìm kiếm thông tin không duyệt hồ sơ
        $searchKhongDuyet = new RegHoSoXnKhaiThacKhongDuyetSearch();
        $dataKhongDuyet = $searchKhongDuyet->search(Yii::$app->request->queryParams);
        $dataKhongDuyet->query->andWhere(['reg_ho_so_xin_khai_thac_id'=>$model->id]);

        return $this->render('view', [
            'model' => $model,
            'dataBKLS'=>$dataBKLS,
            'dataKhongDuyet'=>$dataKhongDuyet,
        ]);
    }

    /**
     * Creates a new RegHoSoXinKhaiThac model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RegHoSoXinKhaiThac();

        if ($model->load(Yii::$app->request->post())) {
            $model->ngay_lap=date("Y-m-d");
            $model->chu_the_id = Yii::$app->session->get('reg_chu_the_id');
            $model->trang_thai_id=RegHoSoXinKhaiThac::TT_HOSO_MOI;
            $model->ngay_bat_dau=Dungchung::convert_to_date($model->ngay_bat_dau);
            $model->ngay_ket_thuc=Dungchung::convert_to_date($model->ngay_ket_thuc);
            $model->loai_hinh_chu_the_id=Yii::$app->session->get('reg_loai_chu_the_id');
            $model->ma = uniqid();
            if($_POST['luuThongTin']  == 'create_update'){
                $model->save();
                Yii::$app->session->setFlash('success',Yii::t('frontend','Tạo hồ sơ mới thành công'));
                return $this->redirect(['view', 'id' => $model->id]);
            }
            if($_POST['luuThongTin']=='create_themBKLS'){
                $model->save();
                Yii::$app->session->setFlash('success',Yii::t('frontend','Tạo hồ sơ mới thành công'));
                return $this->redirect(['/ho-so-xin-khai-thac/chi-tiet-ho-so/create','hoSoKhaiThacID'=>$model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionChiTietHoSo($id)
    {
        $model = $this->findModel($id);

        $searchBKLS = new RegHoSoXinKhaiThacBklsSearch();
        $dataBKLS = $searchBKLS->search(Yii::$app->request->queryParams);
        $dataBKLS->query->andWhere(['reg_ho_so_xin_khai_thac_id'=>$model->id]);

        return $this->render('chi-tiet-ho-so', [
            'model' => $model,
            'dataBKLS'=>$dataBKLS,
        ]);
    }

    /**
     * Updates an existing RegHoSoXinKhaiThac model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDeNghiDuyet($id)
    {
        $model = $this->findModel($id);
        $model->trang_thai_id= RegHoSoXinKhaiThac::TT_HOSO_DENGHIDUYET;
        if($model->save()){
            $modelBKLS = RegHoSoXinKhaiThacBkls::find()->where(['reg_ho_so_xin_khai_thac_id'=>$model->id])->all();
            foreach ($modelBKLS as $bkls){
                $bkls->trang_thai_id= RegHoSoXinKhaiThacBkls::TT_BKLS_DENGHIDUYET;
                $bkls->save();
            }
            Yii::$app->session->setFlash('success',Yii::t('frontend','Chuyển kiểm duyệt hồ sơ thành công'));
            return $this->redirect('index');
        } else {
            Yii::$app->session->setFlash('error',Yii::t('frontend','Không chuyển được hồ sơ. Vui lòng kiểm tra lại hoặc thông báo cho người quản trị'));
        }

    }

    /**
     * Deletes an existing RegHoSoXinKhaiThac model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RegHoSoXinKhaiThac model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RegHoSoXinKhaiThac the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RegHoSoXinKhaiThac::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }

}
