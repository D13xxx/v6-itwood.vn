<?php

namespace backend\modules\DanhMucChung\controllers;

use Yii;
use common\models\SysTrachNhiemTuanThu;
use common\models\searchs\SysTrachNhiemTuanThuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrachNhiemTuanThuController implements the CRUD actions for SysTrachNhiemTuanThu model.
 */
class TrachNhiemTuanThuController extends Controller
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
     * Lists all SysTrachNhiemTuanThu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SysTrachNhiemTuanThuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SysTrachNhiemTuanThu model.
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
     * Creates a new SysTrachNhiemTuanThu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SysTrachNhiemTuanThu();

        if ($model->load(Yii::$app->request->post())) {
            $model->trang_thai_id==SysTrachNhiemTuanThu::TT_ACTIVE;
            if($model->save()){
                Yii::$app->session->setFlash('success',Yii::t('backend','Thêm mới thành công'));
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SysTrachNhiemTuanThu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success',Yii::t('backend','Chỉnh sửa thành công'));
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SysTrachNhiemTuanThu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->trang_thai_id=SysTrachNhiemTuanThu::TT_DELETE;
        $model->nguoi_sua = Yii::$app->user->identity->id;
        $model->ngay_sua=date("Y-m-d H:i:s");
        if($model->save()){
            Yii::$app->session->setFlash('success',Yii::t('backend','Xóa danh mục thành công'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the SysTrachNhiemTuanThu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SysTrachNhiemTuanThu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SysTrachNhiemTuanThu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
