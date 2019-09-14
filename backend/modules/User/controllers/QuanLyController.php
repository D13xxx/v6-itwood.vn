<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/15/2019
 * Time: 9:20 AM
 */

namespace backend\modules\User\controllers;

use backend\models\AuthAssignment;
use backend\models\AuthItem;
use common\models\QuanHuyen;
use common\models\User;
use common\models\UserSearch;
use common\models\XaPhuong;
use mdm\admin\models\form\ChangePassword;
use mdm\admin\models\form\Signup;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class QuanLyController extends Controller
{

    public function actionTaoTaiKhoan()
    {
        $model = new Signup();
        $modelUser = new User();
        $modelQuyenHan = new AuthAssignment();

        if ($model->load(Yii::$app->getRequest()->post()) && $modelUser->load(Yii::$app->request->post())) {

            $quyenHan = Yii::$app->request->post('quyen_han');
            if($quyenHan==''||$quyenHan==null){
                Yii::$app->session->setFlash('error','Chưa phân quyền cho tài khoản, vui lòng phân quyền cho tài khoản');
                return $this->render('tao-tai-khoan',[
                    'model'=>$model,
                    'modelQuyenHan'=>$modelQuyenHan,
                    'modelUser'=>$modelUser
                ]);
            }
            if($quyenHan=='UBNDXA' || $quyenHan=='UBND'){
                if($modelUser->sys_xa_phuong_id==''||$modelUser->sys_xa_phuong_id==null){
                    Yii::$app->session->setFlash('error','Xã phường quản lý không được để trống');
                    return $this->render('tao-tai-khoan',[
                        'model'=>$model,
                        'modelQuyenHan'=>$modelQuyenHan,
                        'modelUser'=>$modelUser
                    ]);
                }
            }
            if($quyenHan=='UBNDHUYEN'||$quyenHan=='HATKIEMLAM'){
                if($modelUser->sys_quan_huyen_id==''||$modelUser->sys_quan_huyen_id==null){
                    Yii::$app->session->setFlash('error','Quận huyện quản lý không được để trống');
                    return $this->render('tao-tai-khoan',[
                        'model'=>$model,
                        'modelQuyenHan'=>$modelQuyenHan,
                        'modelUser'=>$modelUser
                    ]);
                }
            }
            if($quyenHan=='CHICUCKIEMLAM'){
                if($modelUser->sys_tinh_thanh_id==''||$modelUser->sys_tinh_thanh_id==null){
                    Yii::$app->session->setFlash('error','Tỉnh thành quản lý không được để trống');
                    return $this->render('tao-tai-khoan',[
                        'model'=>$model,
                        'modelQuyenHan'=>$modelQuyenHan,
                        'modelUser'=>$modelUser
                    ]);
                }
            }
            if ($user = $model->signup()) {
                $userModel1 = User::find()->where(['id'=>$user->id])->one();
//                print_r($userModel);
                $userModel1->reg_chu_the_id =-1;
                if($quyenHan=='CHICUCKIEMLAM'){
                    $userModel1->sys_tinh_thanh_id = implode(';',$modelUser->sys_tinh_thanh_id);
                }

                if($quyenHan=='UBNDHUYEN' || $quyenHan=='HATKIEMLAM'){
                    $userModel1->sys_quan_huyen_id = implode(';',$modelUser->sys_quan_huyen_id);
                }

                if($quyenHan=='UBNDXA'){
                    $userModel1->sys_xa_phuong_id = implode(';',$modelUser->sys_xa_phuong_id);
                }

                $userModel1->save();
                $modelQuyenHan = new AuthAssignment();
                $modelQuyenHan->item_name = $quyenHan;
                $modelQuyenHan->user_id=$userModel1->id;
//                print_r($modelQuyenHan);
//                exit();
                if($modelQuyenHan->save()){
                    Yii::$app->session->setFlash('success','Thêm tài khoản mới thành công');
                    return $this->redirect('danh-sach-tai-khoan');
                } else {
                    echo '<pre>';
                    print_r($modelQuyenHan->errors);
                    exit();
                }

            }
        }

        return $this->render('tao-tai-khoan',[
            'model'=>$model,
            'modelQuyenHan'=>$modelQuyenHan,
            'modelUser'=>$modelUser
        ]);
    }

    public function actionDanhSachTaiKhoan()
    {
        $search = new UserSearch();
        $dataProvider = $search->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['reg_chu_the_id'=>'-1']);
        $dataProvider->query->andWhere(['<>','user.id',1]);

        return $this->render('danh-sach-tai-khoan',[
            'searchModel'=>$search,
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionPhanQuyenTaiKhoan($id)
    {
        $model = $this->findUser($id);
        $modelQuyenHan = new AuthAssignment();

        if($model->load(Yii::$app->request->post())){
            $quyenHan = Yii::$app->request->post('quyen_han');
            if($quyenHan=='UBNDXA' || $quyenHan=='UBND'){
                if($model->sys_xa_phuong_id==''||$model->sys_xa_phuong_id==null){
                    Yii::$app->session->setFlash('error','Xã phường quản lý không được để trống');
                    return $this->render('phan-quyen-tai-khoan',[
                        'model'=>$model,
                        'modelQuyenHan'=>$modelQuyenHan
                    ]);
                }
            }
            if($quyenHan=='UBNDHUYEN'||$quyenHan=='HATKIEMLAM'){
                if($model->sys_quan_huyen_id==''||$model->sys_quan_huyen_id==null){
                    Yii::$app->session->setFlash('error','Quận huyện quản lý không được để trống');
                    return $this->render('phan-quyen-tai-khoan',[
                        'model'=>$model,
                        'modelQuyenHan'=>$modelQuyenHan
                    ]);
                }
            }
            if($quyenHan=='CHICUCKIEMLAM'){
                if($model->sys_tinh_thanh_id==''||$model->sys_tinh_thanh_id==null){
                    Yii::$app->session->setFlash('error','Tỉnh thành quản lý không được để trống');
                    return $this->render('phan-quyen-tai-khoan',[
                        'model'=>$model,
                        'modelQuyenHan'=>$modelQuyenHan
                    ]);
                }
            }

            $model->save();
            $modelQuyenHan->item_name = $quyenHan;
            $modelQuyenHan->user_id=$id;
            $modelQuyenHan->save();
            Yii::$app->session->setFlash('success','Phân quyền cho tài khoản thành công');
        }

        return $this->render('phan-quyen-tai-khoan',[
            'model'=>$model,
            'modelQuyenHan'=>$modelQuyenHan
        ]);
    }

    private function findUser($id)
    {
        if(($model=User::findOne($id))!==null){
            return $model;
        }

        throw new NotFoundHttpException('Không tìm thấy tài khoản này');
    }

    public function actionThongTinTaiKhoan($id)
    {

    }

    public function actionDoiMatKhau($id=0)
    {
        $model = new ChangePassword();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->change($id)) {
            Yii::$app->session->setFlash('success','Thay đổi mật khẩu thành công');
            return $this->redirect('/user/quan-ly/danh-sach-tai-khoan');
        }

        return $this->render('change-password', [
            'model' => $model,
        ]);
    }

    public function actionDanhSachQuanHuyen($id)
    {
        $idArray= Yii::$app->request->get('tinhThanhID');

        $rows= QuanHuyen::find()->where(['in','tinh_thanh_id',$idArray])->active()->all();
        if(count($rows)>0){
//            echo "<option disabled selected hidden>".Yii::t('backend','Lựa chọn Quận huyện') ."</option>";
            foreach($rows as $row){
                echo "<option value='$row->id'>$row->ten</option>";
            }
        }
        else{
//            echo "<option disabled selected hidden>".Yii::t('backend','Lựa chọn Quận huyện') ."</option>";
        }
    }
    public function actionDanhSachXaPhuong($id)
    {
        $idArray= Yii::$app->request->get('quanHuyenID');
        $rows= XaPhuong::find()->where(['IN','quan_huyen_id',$idArray])->active()->all();
        if(count($rows)>0){
//            echo "<option disabled selected hidden>".Yii::t('backend','Lựa chọn xã phường')."</option>";
            foreach($rows as $row){
                echo "<option value='$row->id'>$row->ten</option>";
            }
        }
        else{
//            echo "<option disabled selected hidden>".Yii::t('backend','Lựa chọn Quận huyện') ."</option>";
        }
    }
}