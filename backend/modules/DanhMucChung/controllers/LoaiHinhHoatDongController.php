<?php

namespace backend\modules\DanhMucChung\controllers;

use Yii;
use common\models\SysLoaiHinhHoatDong;
use common\models\searchs\SysLoaiHinhHoatDongSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LoaiHinhHoatDongController implements the CRUD actions for SysLoaiHinhHoatDong model.
 */
class LoaiHinhHoatDongController extends Controller
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
     * Lists all SysLoaiHinhHoatDong models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SysLoaiHinhHoatDongSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['trang_thai_id'=>SysLoaiHinhHoatDong::TT_ACTIVE]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SysLoaiHinhHoatDong model.
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
     * Creates a new SysLoaiHinhHoatDong model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SysLoaiHinhHoatDong();

        if ($model->load(Yii::$app->request->post())) {
            $model->nguoi_tao_id=Yii::$app->user->identity->id;
            $model->ngay_tao=date("Y-m-d H:i:s");
            $model->trang_thai_id=SysLoaiHinhHoatDong::TT_ACTIVE;
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
     * Updates an existing SysLoaiHinhHoatDong model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->ngay_sua=date("Y-m-d H:i:s");
            $model->nguoi_sua_id=Yii::$app->user->identity->id;
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
     * Deletes an existing SysLoaiHinhHoatDong model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->trang_thai_id=SysLoaiHinhHoatDong::TT_ISDELETE;
        $model->nguoi_sua_id=Yii::$app->user->identity->id;
        $model->ngay_sua=date("Y-m-d H:i:s");
        if($model->save()){
            Yii::$app->session->setFlash('success',Yii::t('backend','Xóa danh mục thành công'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the SysLoaiHinhHoatDong model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SysLoaiHinhHoatDong the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SysLoaiHinhHoatDong::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
