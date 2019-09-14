<?php

namespace frontend\modules\QuyenSuDungDatVaRung\controllers;

use common\models\Dungchung;
use common\models\RegLoRung;
use common\models\searchs\RegLoRungSearch;
use frontend\controllers\base\PController;
use Yii;
use common\models\RegQuyenSuDungDat;
use common\models\searchs\RegQuyenSuDungDatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * QuyenSuDungDatVaRungController implements the CRUD actions for RegQuyenSuDungDat model.
 */
class QuyenSuDungDatVaRungController extends PController
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
     * Lists all RegQuyenSuDungDat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RegQuyenSuDungDatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere(['chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RegQuyenSuDungDat model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $searchLoRung = new RegLoRungSearch();
        $dataLoRung = $searchLoRung->search(Yii::$app->request->queryParams);
        $dataLoRung->query->andWhere(['and',['reg_lo_rung.chu_the_id'=>$model->chu_the_id],['quyen_sdd_id'=>$model->id]]);
        return $this->render('view', [
            'model' => $model,
            'dataLoRung'=>$dataLoRung,
            'searchLoRung'=>$searchLoRung,
        ]);
    }

    /**
     * Creates a new RegQuyenSuDungDat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RegQuyenSuDungDat();
        $searchLoRung = new RegLoRungSearch();
        $dataLoRung = $searchLoRung->search(Yii::$app->request->queryParams);

        if($model->load(Yii::$app->request->post())){
            if($_POST['luuThongTin']  == 'create_update'){

                $tepDinhKems= UploadedFile::getInstances($model,'file_dinh_kem');
                $fileDinhKem=[];
                $model->ma=uniqid();
                foreach ($tepDinhKems as $temDinhKem)
                {
                    if(!file_exists(Yii::getAlias('@images').'/uploads/quyen-su-dung-dat')){
                        mkdir(Yii::getAlias('@images').'/uploads/quyen-su-dung-dat',0777,true);
                    }

                    Yii::$app->params['uploads']=Yii::getAlias('@images').'/uploads/quyen-su-dung-dat/';
                    $moRong = $temDinhKem->extension;
                    $tenFile =$temDinhKem->baseName;
                    $path=Yii::$app->params['uploads'].$model->ma.'-'.Dungchung::TaoMaSlug($tenFile).'.'.$moRong;
                    $fileDinhKem[]=$model->ma.'-'.Dungchung::TaoMaSlug($tenFile).'.'.$moRong;
                    $temDinhKem->saveAs($path);
                }
                $model->file_dinh_kem=implode(';',$fileDinhKem);
                $model->ngay_ban_hanh=Dungchung::convert_to_date($model->ngay_ban_hanh);
                $model->trang_thai_id= RegQuyenSuDungDat::TT_ACTIVE;
                $model->chu_the_id=Yii::$app->session->get('reg_chu_the_id');
                $model->loai_chu_the_id = Yii::$app->session->get('reg_loai_chu_the_id');

                if($model->save()){
                    Yii::$app->session->setFlash('success',Yii::t('frontend','Thêm mới thành công'));
                    return $this->redirect('index');
                }
            }
            if($_POST['luuThongTin']=='themRung'){
                $tepDinhKems= UploadedFile::getInstances($model,'file_dinh_kem');
                $fileDinhKem=[];
                $model->ma=uniqid();
                foreach ($tepDinhKems as $temDinhKem)
                {
                    if(!file_exists(Yii::getAlias('@images').'/uploads/quyen-su-dung-dat')){
                        mkdir(Yii::getAlias('@images').'/uploads/quyen-su-dung-dat',0777,true);
                    }

                    Yii::$app->params['uploads']=Yii::getAlias('@images').'/uploads/quyen-su-dung-dat/';
                    $moRong = $temDinhKem->extension;
                    $tenFile =$temDinhKem->baseName;
                    $path=Yii::$app->params['uploads'].$model->ma.'-'.Dungchung::TaoMaSlug($tenFile).'.'.$moRong;
                    $fileDinhKem[]=$model->ma.'-'.Dungchung::TaoMaSlug($tenFile).'.'.$moRong;
                    $temDinhKem->saveAs($path);
                }
                $model->file_dinh_kem=implode(';',$fileDinhKem);
                $model->ngay_ban_hanh=Dungchung::convert_to_date($model->ngay_ban_hanh);
                $model->trang_thai_id= RegQuyenSuDungDat::TT_ACTIVE;
                $model->chu_the_id=Yii::$app->session->get('reg_chu_the_id');
                $model->loai_chu_the_id = Yii::$app->session->get('reg_loai_chu_the_id');

                if($model->save()){
                    Yii::$app->session->setFlash('success',Yii::t('frontend','Thêm mới thành công'));
                    return $this->redirect(['them-lo-rung-moi','id'=>$model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'searchLoRung'=>$searchLoRung,
            'dataLoRung'=>$dataLoRung,
        ]);
    }

//    public function actionThemLoRung($id)
//    {
//        $model = $this->findModel($id);
//
//        $searchLoRung = new RegLoRungSearch();
//        $dataLoRung = $searchLoRung->search(Yii::$app->request->queryParams);
//        return $this->render('them-lo-rung', [
//            'model' => $model,
//            'searchLoRung'=>$searchLoRung,
//            'dataLoRung'=>$dataLoRung,
//        ]);
//    }
    /**
     * Updates an existing RegQuyenSuDungDat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $fileDinhKemCu = $model->file_dinh_kem;
        $ngayBanHanhCu = $model->ngay_ban_hanh;

        $searchLoRung = new RegLoRungSearch();
        $dataLoRung = $searchLoRung->search(Yii::$app->request->queryParams);
        $dataLoRung->query->andWhere(['quyen_sdd_id'=>$model->id]);

        if($model->load(Yii::$app->request->post())){
            if($_POST['luuThongTin']  == 'create_update'){
                if($model->ngay_ban_hanh==''||$model->ngay_ban_hanh==null){
                    $model->ngay_ban_hanh=$ngayBanHanhCu;
                } elseif($model->ngay_ban_hanh ==$ngayBanHanhCu) {
                    $model->ngay_ban_hanh=$ngayBanHanhCu;
                } else {
                    $model->ngay_ban_hanh = Dungchung::convert_to_date($model->ngay_ban_hanh);
                }

                $tepDinhKems= UploadedFile::getInstances($model,'file_dinh_kem');
                $fileDinhKem=[];
                $model->ma=uniqid();
                foreach ($tepDinhKems as $temDinhKem)
                {
                    if(!file_exists(Yii::getAlias('@images').'/uploads/quyen-su-dung-dat')){
                        mkdir(Yii::getAlias('@images').'/uploads/quyen-su-dung-dat',0777,true);
                    }

                    Yii::$app->params['uploads']=Yii::getAlias('@images').'/uploads/quyen-su-dung-dat/';
                    $moRong = $temDinhKem->extension;
                    $tenFile =$temDinhKem->baseName;
                    $path=Yii::$app->params['uploads'].$model->ma.'-'.Dungchung::TaoMaSlug($tenFile).'.'.$moRong;
                    $fileDinhKem[]=$model->ma.'-'.Dungchung::TaoMaSlug($tenFile).'.'.$moRong;
                    $temDinhKem->saveAs($path);
                }
                $model->file_dinh_kem=implode(';',$fileDinhKem);

                $model->trang_thai_id= RegQuyenSuDungDat::TT_ACTIVE;
                $model->chu_the_id=Yii::$app->session->get('reg_chu_the_id');
                $model->loai_chu_the_id = Yii::$app->session->get('reg_loai_chu_the_id');

                if($model->save()){
                    Yii::$app->session->setFlash('success',Yii::t('frontend','Thêm mới thành công'));
//                    return $this->redirect(['them-lo-rung-moi','id'=>$model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'searchLoRung'=>$searchLoRung,
            'dataLoRung'=>$dataLoRung,
        ]);
    }

    public function actionThemLoRungMoi($id)
    {
        $model = $this->findModel($id);
        $searchLoRung = new RegLoRungSearch();
        $dataLoRung = $searchLoRung->search(Yii::$app->request->queryParams);
		$dataLoRung->query->andWhere(['reg_lo_rung.chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')]);
        $dataLoRung->query->andWhere(['quyen_sdd_id'=>$model->id]);
        return $this->render('them-lo-rung-moi', [
            'model' => $model,
            'searchLoRung'=>$searchLoRung,
            'dataLoRung'=>$dataLoRung,
        ]);
    }

    /**
     * Deletes an existing RegQuyenSuDungDat model.
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
     * Finds the RegQuyenSuDungDat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RegQuyenSuDungDat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RegQuyenSuDungDat::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }
}
