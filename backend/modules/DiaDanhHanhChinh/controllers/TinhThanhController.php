<?php

namespace backend\modules\DiaDanhHanhChinh\controllers;

use Yii;
use common\models\TinhThanh;
use common\models\searchs\TinhThanhSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TinhThanhController implements the CRUD actions for TinhThanh model.
 */
class TinhThanhController extends Controller
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
     * Lists all TinhThanh models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TinhThanhSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['trang_thai'=>TinhThanh::TT_ACTIVE]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TinhThanh model.
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
     * Creates a new TinhThanh model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TinhThanh();

        if ($model->load(Yii::$app->request->post())) {
            $model->trang_thai=TinhThanh::TT_ACTIVE;
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
     * Updates an existing TinhThanh model.
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
     * Deletes an existing TinhThanh model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->trang_thai= TinhThanh::TT_ISDELETE;
        $model->nguoi_xoa= Yii::$app->user->identity->id;
        $model->ngay_xoa=date("Y-m-d H:i:s");
        if($model->save()){
            Yii::$app->session->setFlash('success',Yii::t('backend','Xóa danh mục thành công'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the TinhThanh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TinhThanh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TinhThanh::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
