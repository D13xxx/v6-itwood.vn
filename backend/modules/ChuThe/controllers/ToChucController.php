<?php

namespace backend\modules\ChuThe\controllers;

use common\models\RegChuTheToChucKhongDuyet;
use common\models\searchs\RegChuTheToChucKhongDuyetSearch;
use common\models\User;
use Yii;
use common\models\RegChuTheToChuc;
use common\models\searchs\RegChuTheToChucSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ToChucController implements the CRUD actions for RegChuTheToChuc model.
 */
class ToChucController extends Controller
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
     * Lists all RegChuTheToChuc models.
     * @return mixed
     */
    public function actionDeNghiDuyet()
    {

        $searchModel = new RegChuTheToChucSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['trang_thai_id'=>RegChuTheToChuc::TT_NEWREG]);

        $nguoiKiemDuyet = User::find()->where(['id'=>Yii::$app->user->id])->one();
        if(Yii::$app->session->get('quyenHan')=='UBNDHUYEN' || Yii::$app->session->get('quyenHan')=='HATKIEMLAM'){
            $dataProvider->query->andWhere(['reg_chu_the_to_chuc.quan_huyen_id'=>$nguoiKiemDuyet->sys_quan_huyen_id]);
        }
        if(Yii::$app->session->get('quyenHan')=='CHICUCKIEMLAM') {
            $dataProvider->query->andWhere(['reg_chu_the_to_chuc.tinh_thanh_id'=>$nguoiKiemDuyet->sys_tinh_thanh_id]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDaDuocDuyet()
    {
        $searchModel = new RegChuTheToChucSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['trang_thai_id'=>RegChuTheToChuc::TT_ACTIVE]);

        $nguoiKiemDuyet = User::find()->where(['id'=>Yii::$app->user->id])->one();
        if(Yii::$app->session->get('quyenHan')=='UBNDHUYEN' || Yii::$app->session->get('quyenHan')=='HATKIEMLAM'){
            $dataProvider->query->andWhere(['in','reg_chu_the_to_chuc.quan_huyen_id',explode(';',$nguoiKiemDuyet->sys_quan_huyen_id)]);
        }
        if(Yii::$app->session->get('quyenHan')=='CHICUCKIEMLAM') {
            $dataProvider->query->andWhere(['in','reg_chu_the_to_chuc.tinh_thanh_id',explode(';',$nguoiKiemDuyet->sys_tinh_thanh_id)]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionKhongDuocDuyet()
    {
        $searchModel = new RegChuTheToChucSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['trang_thai_id'=>RegChuTheToChuc::TT_NOACTIVE]);
        $nguoiKiemDuyet = User::find()->where(['id'=>Yii::$app->user->id])->one();
        if(Yii::$app->session->get('quyenHan')=='UBNDHUYEN' || Yii::$app->session->get('quyenHan')=='HATKIEMLAM'){
            $dataProvider->query->andWhere(['in','reg_chu_the_to_chuc.quan_huyen_id',explode(';',$nguoiKiemDuyet->sys_quan_huyen_id)]);
        }
        if(Yii::$app->session->get('quyenHan')=='CHICUCKIEMLAM') {
            $dataProvider->query->andWhere(['in','reg_chu_the_to_chuc.tinh_thanh_id',explode(';',$nguoiKiemDuyet->sys_tinh_thanh_id)]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single RegChuTheToChuc model.
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


    public function actionDuyetChuThe($id)
    {
        $model = $this->findModel($id);
        $model->loai_hinh_hoat_dong_id_array=$model->loai_hinh_hoat_dong_id;
        $model->trang_thai_id=RegChuTheToChuc::TT_ACTIVE;
        $model->nguoi_duyet=Yii::$app->user->identity->id;
        $model->ngay_duyet = date("Y-m-d H:i:s");

        if($model->save()){
            $modelUser = new User();
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $matkhau = substr(str_shuffle($permitted_chars),0,8);

            $modelUser->username = $model->ma_so_thue;
            $modelUser->fullname = $model->ten_to_chuc;
            $modelUser->password_hash = Yii::$app->security->generatePasswordHash($matkhau);
            $modelUser->auth_key = Yii::$app->security->generateRandomString();
            $modelUser->status = User::STATUS_ACTIVE;
            $modelUser->reg_chu_the_id = $model->id;
            $modelUser->loai_chu_the_id = 1;
            if($model->email=='' | $model->email ==null){
                $modelUser->email = $model->so_cmtnd.'@itwood.vn';
            } else {
                $modelUser->email = $model->email;
            }

            $sendMail= Yii::$app->mailer->compose()
                ->setFrom([Yii::$app->params['supportEmail']=>'Hỗ trợ ITWOOD'])
                ->setTo($modelUser->email)
                ->setSubject(' [iTwood] Xác nhận mật khẩu chủ thể')
                ->setHtmlBody('Kính gửi: ' . $modelUser->fullname .
                    '<br>Bạn đã đăng ký vào hệ thống iTwood vào thời gian: '.date("d/m/Y",strtotime($model->ngay_tao)).
                    '. Hệ thống đã xem xét và đồng ý cho bạn tham gia sử dụng hệ thống. '.
                    '<br> Thông tin đăng nhập vào hệ thống:'.
                    '<br><b>Tên đăng nhập:</b> '.$modelUser->username.
                    '<br><b>Mật khẩu truy cập:</b> '.$matkhau)
                ->send();
            if($sendMail){
                $modelUser->save();
                Yii::$app->session->setFlash('success',Yii::t('backend','Phê duyệt chủ thể thành công'));
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error','Không gửi được email');
            }

        } else {
            echo '<pre>';
            print_r($model->errors);
            exit();
        }
    }

    /**
     * Deletes an existing RegChuTheToChuc model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RegChuTheToChuc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RegChuTheToChuc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RegChuTheToChuc::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }

    public function actionViewFile($id,$fileName)
    {
        $model = $this->findModel($id);

        return $this->renderAjax('view-file',['fileName'=>$fileName]);
    }


    public function actionKhongDuyet($id){
        $model = new RegChuTheToChucKhongDuyet();

        if($model->load(Yii::$app->request->post())){
            $model->chu_the_id = $id;
            $model->nguoi_lap = Yii::$app->user->identity->id;
            $model->ngay_lap=date("Y-m-d H:i:s");
            if($model->save()){
                $modelTC = $this->findModel($id);
                $modelTC->loai_hinh_hoat_dong_id_array=$modelTC->loai_hinh_hoat_dong_id;
                $modelTC->nguoi_duyet=Yii::$app->user->identity->id;
                $modelTC->ngay_duyet = date("Y-m-d H:i:s");
                $modelTC->trang_thai_id = RegChuTheToChuc::TT_NOACTIVE;
                $modelTC->save();
                Yii::$app->session->setFlash('success',Yii::t('backend','Thêm mới thành công'));
                return $this->redirect(['view', 'id' => $id]);
            }
        }

        return $this->renderAjax('khong-duyet',[
            'model'=>$model
        ]);
    }

    public function actionLyDoKhongDuyet($id){
        $searchModel = new RegChuTheToChucKhongDuyetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['chu_the_id'=>$id]);

        return $this->renderAjax('ly-do-khong-duyet',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function findKhongDuyet($id)
    {
        if (($model = RegChuTheToChucKhongDuyet::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }

}
