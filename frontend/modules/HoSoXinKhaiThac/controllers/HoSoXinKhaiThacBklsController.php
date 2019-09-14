<?php

namespace frontend\modules\HoSoXinKhaiThac\controllers;

use frontend\controllers\base\PController;
use Yii;
use common\models\RegHoSoXinKhaiThacBkls;
use common\models\searchs\RegHoSoXinKhaiThacBklsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HoSoXinKhaiThacBklsController implements the CRUD actions for RegHoSoXinKhaiThacBkls model.
 */
class HoSoXinKhaiThacBklsController extends PController
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
     * Lists all RegHoSoXinKhaiThacBkls models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RegHoSoXinKhaiThacBklsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RegHoSoXinKhaiThacBkls model.
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
     * Creates a new RegHoSoXinKhaiThacBkls model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RegHoSoXinKhaiThacBkls();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RegHoSoXinKhaiThacBkls model.
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

    /**
     * Deletes an existing RegHoSoXinKhaiThacBkls model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id,$hoSoDangKyKhaiThacID)
    {
        $model = $this->findModel($id);
//        $modelHoSoDangKyKhaiThac = $this->findHoSoKhaiThac($model);

        $model->delete();

        return $this->redirect(['/ho-so-xin-khai-thac/ho-so-xin-khai-thac/view','id'=>$hoSoDangKyKhaiThacID]);
    }

    /**
     * Finds the RegHoSoXinKhaiThacBkls model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RegHoSoXinKhaiThacBkls the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RegHoSoXinKhaiThacBkls::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }
}
