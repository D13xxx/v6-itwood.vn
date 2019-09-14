<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/12/2019
 * Time: 4:17 PM
 */

namespace frontend\modules\ChuThe\controllers;

use common\models\RegChuTheHoGiaDinh;
use common\models\RegChuTheToChuc;
use common\models\User;
use frontend\controllers\base\PController;
use mdm\admin\models\form\ChangePassword;
use Yii;
use yii\web\NotFoundHttpException;

class ThongTinController extends PController
{
    public function actionIndex()
    {

        $modelUser = User::find()->where(['id'=>Yii::$app->session->get('reg_user_id')])->one();

        if($modelUser->loai_chu_the_id==1){
            $model = $this->findToChuc($modelUser->reg_chu_the_id);
        } else {
            $model = $this->findHoGiaDinh($modelUser->reg_chu_the_id);
        }

        return $this->render('index',['model'=>$model,'modelUser'=>$modelUser]);

    }



    public function actionDoiMatKhau($id=0)
    {
        $model = new ChangePassword();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->change($id)) {
            Yii::$app->session->setFlash('success','Thay đổi mật khẩu thành công');
            return $this->redirect('/ban-lam-viec');
        }

        return $this->render('doi-mat-khau',['model'=>$model]);
    }

    protected function findToChuc($id)
    {
        if(($model=RegChuTheToChuc::findOne($id))!==null){
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend','Không tìm thấy chủ thể tổ chức này'));
    }

    protected function findHoGiaDinh($id)
    {
        if(($model=RegChuTheHoGiaDinh::findOne($id))!==null)
        {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend','Không tìm thấy chủ thể hộ gia đình này'));
    }

    protected function findUser($id)
    {
        if(($model=User::findOne($id))!==null){
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend','Không tìm thấy tài khoản này'));
    }
}