<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/19/2018
 * Time: 9:44 AM
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;

class PhongBanController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}