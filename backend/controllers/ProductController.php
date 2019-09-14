<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/19/2018
 * Time: 9:44 AM
 */

namespace backend\controllers;

use backend\models\Catalogs;
use Yii;
use yii\web\Controller;

class ProductController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

//    public function actionSave()
//    {
//        $model = new Catalogs();
//        if($model->load(Yii::$app->request->post()) && $model->save()){
//            Yii::$app->session->setFlash('success','Thêm mới thành công');
//        }
//        return $this->render('create',['model'=>$model]);
//    }
//
//    public function actionProduct($id)
//    {
//        return $this->renderAjax('test1',['model'=>$id]);
//    }
}