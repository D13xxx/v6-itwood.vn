<?php

namespace backend\modules\DiaDanhHanhChinh\controllers;

use Yii;
use common\models\XaPhuong;
use common\models\searchs\XaPhuongSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * XaPhuongController implements the CRUD actions for XaPhuong model.
 */
class XaPhuongController extends Controller
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
     * Lists all XaPhuong models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new XaPhuongSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['xa_phuong.trang_thai'=>XaPhuong::TT_ACTIVE]);
        $dataProvider->query->orderBy(['quan_huyen_id'=>SORT_ASC,'tinh_thanh_id'=>SORT_ASC,'id'=>SORT_ASC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single XaPhuong model.
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
     * Creates a new XaPhuong model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new XaPhuong();

        if ($model->load(Yii::$app->request->post())) {
            $model->trang_thai=XaPhuong::TT_ACTIVE;
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
     * Updates an existing XaPhuong model.
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
     * Deletes an existing XaPhuong model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->trang_thai=XaPhuong::TT_ISDELETE;
        $model->nguoi_xoa= Yii::$app->user->identity->id;
        $model->ngay_xoa=date("Y-m-d H:i:s");
        if($model->save()){
            Yii::$app->session->setFlash('success',Yii::t('backend','Xóa danh mục thành công'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the XaPhuong model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return XaPhuong the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = XaPhuong::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }

    public function actionDanhSachXaPhuong($id)
    {
        $rows= XaPhuong::find()->where(['quan_huyen_id'=>$id])->active()->all();
        if(count($rows)>0){
            echo "<option value='0'>".Yii::t('backend','Lựa chọn xã phường')."</option>";
            foreach($rows as $row){
                echo "<option value='$row->id'>$row->ten</option>";
            }
        }
        else{
            echo "<option value='0'>".Yii::t('backend','Không có xã phường thuộc quận huyện này.')."</option>";
        }
    }
}
