<?php

namespace backend\modules\DanhMucChung\controllers;

use Yii;
use common\models\SysLoaiRung;
use common\models\searchs\SysLoaiRungSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LoaiRungController implements the CRUD actions for SysLoaiRung model.
 */
class LoaiRungController extends Controller
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
     * Lists all SysLoaiRung models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SysLoaiRungSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['<>','trang_thai_id',SysLoaiRung::TT_ISDELETE]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SysLoaiRung model.
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
     * Creates a new SysLoaiRung model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SysLoaiRung();

        if ($model->load(Yii::$app->request->post())) {
            $model->trang_thai_id=SysLoaiRung::TT_ACTIVE;
            $model->nguoi_tao=Yii::$app->user->identity->id;
            $model->ngay_tao=date("Y-m-d H:i:s");
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
     * Updates an existing SysLoaiRung model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->nguoi_sua=Yii::$app->user->identity->id;
            $model->ngay_sua=date("Y-m-d H:i:s");
            if($model->save())
            {
                Yii::$app->session->setFlash('success',Yii::t('backend','Chỉnh sửa thành công'));
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SysLoaiRung model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->trang_thai_id=SysLoaiRung::TT_ISDELETE;
        $model->nguoi_sua=Yii::$app->user->identity->id;
        $model->ngay_sua=date("Y-m-d H:i:s");
        if($model->save()){
            Yii::$app->session->setFlash('success',Yii::t('backend','Xóa danh mục thành công'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the SysLoaiRung model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SysLoaiRung the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SysLoaiRung::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
