<?php

namespace frontend\modules\QuyenSuDungDatVaRung\controllers;

use common\models\QuanHuyen;
use common\models\RegQuyenSuDungDat;
use common\models\XaPhuong;
use frontend\controllers\base\PController;
use Yii;
use common\models\RegLoRung;
use common\models\searchs\RegLoRungSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\View;

/**
 * LoRungController implements the CRUD actions for RegLoRung model.
 */
class LoRungController extends PController
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
     * Lists all RegLoRung models.
     * @return mixed
     */

    public function actionDanhSachLoRung($chuTheID,$soDoID)
    {
        $searchLoRung = new RegLoRungSearch();
        $dataLoRung = $searchLoRung->search(Yii::$app->request->queryParams);
        $dataLoRung->query->andWhere(['and',['chu_the_id'=>$chuTheID],['quyen_sdd_id'=>$soDoID]]);

        return $this->renderAjax('danh-sach-lo-rung',[
            'search'=>$searchLoRung,
            'dataProvider'=>$dataLoRung
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new RegLoRungSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_lo_rung.chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')]);
        $dataProvider->query->orderBy(['quyen_sdd_id'=>SORT_ASC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RegLoRung model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RegLoRung model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($soDoID)
    {
        $model = new RegLoRung();

        if($model->load(Yii::$app->request->post()) && $model->validate()){

            if($model->tieu_khu==''||$model->khoanh==''||$model->lo==''){
                $model->khong_co_dinh_danh=1;
            }

            if($model->tieu_khu==''||$model->tieu_khu==null){
                $model->tieu_khu=$model->to_ban_do_so;
            }
            if($model->khoanh==''||$model->khoanh==null){
                $model->khoanh=$model->so_thua_dat;
            }

            $model->ma=$model->tieu_khu.'-'.$model->khoanh.'-'.$model->lo;
            $model->chu_the_id= Yii::$app->session->get('reg_chu_the_id');
            $model->loai_hinh_chu_the = Yii::$app->session->get('reg_loai_chu_the_id');
            $model->nguoi_tao_id= Yii::$app->user->identity->id;
            $model->trang_thai_id=RegLoRung::TT_RUNGMOIKHAIBAO;
            $model->quyen_sdd_id= $soDoID;
            if($model->save()){
                $result = 'success';
//                Yii::$app->response->format = trim(Response::FORMAT_JSON);
                return $result;
            } else {
                $error = \yii\widgets\ActiveForm::validate($model);
                //Yii::$app->response->format = trim(Response::FORMAT_JSON);
                return $error;
            }

        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RegLoRung model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $coDinhDanh = $model->khong_co_dinh_danh;
        if ($model->load(Yii::$app->request->post())) {
            if($model->khong_co_dinh_danh==1 && $coDinhDanh != $model->khong_co_dinh_danh){
                $modelSoDo = RegQuyenSuDungDat::find()->where(['id'=>$model->quyen_sdd_id])->one();
                $loRungDaCos = RegLoRung::find()->where(['quyen_sdd_id'=>$model->quyen_sdd_id])->all();
                $maLo=array();
                foreach ($loRungDaCos as $key => $loRungDaCo)
                {
                    $maLo1=explode('-',$loRungDaCo->lo);
                    if(isset($maLo1[1])){
                        $maLo[]=$maLo1[1];
                    }
                }
                $tam = max($maLo);
                $maxTam = $tam+1;
                $model->tieu_khu=$modelSoDo->so_van_ban;
                $model->khoanh= $modelSoDo->ngay_ban_hanh;
                $model->lo = $modelSoDo->co_quan_ban_hanh.'-'.$maxTam;
            }
            $model->ma=$model->tieu_khu.'-'.$model->khoanh.'-'.$model->lo;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RegLoRung model.
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
     * Finds the RegLoRung model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RegLoRung the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RegLoRung::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }

    public function actionDeNghiDuyet()
    {
        if (Yii::$app->request->isAjax) {
            $data= Yii::$app->request->post('keylist');
            foreach ($data as $value){
                $model = $this->findModel($value);
                $model->trang_thai_id= RegLoRung::TT_RUNGDENGHIDUYET;
                $model->save();
            }
        }
    }

}
