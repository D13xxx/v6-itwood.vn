<?php

namespace backend\modules\DanhMucChung\controllers;

use common\models\RegSystemFormis;
use common\models\searchs\RegSystemFormisSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class KetNoiFormisController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new RegSystemFormisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new RegSystemFormis();

        if ($model->load(Yii::$app->request->post())) {
            $model->ngay_khoi_tao= date("Y-m-d H:s:i");
            $model->nguoi_khoi_tao = Yii::$app->user->id;
            if($model->save()){
                Yii::$app->session->setFlash('success', [
                    'body' => Yii::t('backend', 'Thêm kết nối với FORMIS thành công.')
                ]);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = RegSystemFormis::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
