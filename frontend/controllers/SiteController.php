<?php
namespace frontend\controllers;

use common\models\Banner;
use common\models\QuanHuyen;
use common\models\RegChuTheHoGiaDinh;
use common\models\RegChuTheToChuc;
use common\models\searchs\RegChuTheHoGiaDinhSearch;
use common\models\searchs\RegChuTheToChucSearch;
use common\models\searchs\RegLoRungSearch;
use common\models\TinTuc;
use common\models\User;
use common\models\XaPhuong;
use frontend\models\QuenMatKhau;
use http\Url;
use Yii;
use yii\base\DynamicModel;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->redirect('/truy-xuat');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
        if(Yii::$app->session->get('reg_chu_the_id')!=''){
            Yii::$app->user->logout();
            Yii::$app->session->destroy();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $modelUser = User::findOne(['username'=>$model->username]);
            Yii::$app->session->set('reg_chu_the_id',$modelUser->reg_chu_the_id);
            Yii::$app->session->set('reg_loai_chu_the_id',$modelUser->loai_chu_the_id);
            Yii::$app->session->set('reg_chu_the_ten',$modelUser->fullname);
            Yii::$app->session->set('reg_user_id',$modelUser->id);

//            Yii::$app->session->set('reg_chu_the_ma',$modelUser->username);
            return $this->redirect('/ban-lam-viec');

        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        Yii::$app->session->destroy();
        return $this->redirect('http://itwood.vn');
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
//    public function actionRequestPasswordReset()
//    {
//        $model = new PasswordResetRequestForm();
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($model->sendEmail()) {
//                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
//
//                return $this->goHome();
//            } else {
//                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
//            }
//        }
//
//        return $this->render('requestPasswordResetToken', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
//    public function actionResetPassword($token)
//    {
//        try {
//            $model = new ResetPasswordForm($token);
//        } catch (InvalidParamException $e) {
//            throw new BadRequestHttpException($e->getMessage());
//        }
//
//        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
//            Yii::$app->session->setFlash('success', 'New password saved.');
//
//            return $this->goHome();
//        }
//
//        return $this->render('resetPassword', [
//            'model' => $model,
//        ]);
//    }
//
//    public function actionTest()
//    {
//        $this->layout = '@app/views/layouts/private_main';
//        return $this->render('test');
//    }

    public function actionDanhSachQuanHuyen($id)
    {
        $rows= QuanHuyen::find()->where(['tinh_thanh_id'=>$id])->active()->all();
        if(count($rows)>0){
            echo "<option disabled selected hidden>".Yii::t('frontend','Lựa chọn Quận huyện') ."</option>";
            foreach($rows as $row){
                echo "<option value='$row->id'>$row->ten</option>";
            }
        }
        else{
            echo "<option disabled selected hidden>".Yii::t('frontend','Lựa chọn Quận huyện') ."</option>";
        }
    }
    public function actionDanhSachXaPhuong($id)
    {
        $rows= XaPhuong::find()->where(['quan_huyen_id'=>$id])->active()->all();
        if(count($rows)>0){
            echo "<option disabled selected hidden>".Yii::t('frontend','Lựa chọn xã phường')."</option>";
            foreach($rows as $row){
                echo "<option value='$row->id'>$row->ten</option>";
            }
        }
        else{
            echo "<option disabled selected hidden>".Yii::t('frontend','Lựa chọn Quận huyện') ."</option>";
        }
    }


    public function actionQuenMatKhau()
    {
//        $model = new PasswordResetRequestForm();
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($model->sendEmail()) {
//                Yii::$app->session->setFlash('success', 'Vui lòng kiểm tra email để lấy được thông tin tài khoản mới.');
//                return $this->goHome();
//            } else {
//                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
//            }
//        }
//
//        return $this->render('requestPasswordResetToken', [
//            'model' => $model,
//        ]);

        $model= new QuenMatKhau();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $modelUser=User::findOne([
                'email'=>$model->email,
                'username'=>$model->user_id
            ]);
            if(!$modelUser){
                Yii::$app->session->setFlash('error','Kiểm tra lại tài khoản đăng đăng ký và email đăng ký');
                return $this->render('quen-mat-khau',['model'=>$model]);
            } else {
                if(!User::isPasswordResetTokenValid($modelUser->password_reset_token)){
                    $modelUser->generatePasswordResetToken();
                    $modelUser->save();
                }

                $linkReset = \yii\helpers\Url::base(true).'/site/resetpassword?paswordtoken='.$modelUser->password_reset_token.'&username='.$modelUser->username;

                try {
                    Yii::$app->mailer->compose()
                        ->setFrom([Yii::$app->params['supportEmail']=>'Hỗ trợ ITWOOD'])
                        ->setTo($modelUser->email)
                        ->setSubject('Thông tin đặt lại mật khẩu')
                        ->setHtmlBody('Kính gửi: ' . $modelUser->fullname .
                            '<br>Để lấy lại mật khẩu vui lòng lựa chọn vào đường dẫn dưới đây để tiếp tục'.
                            '<br><b>Link lấy lại mật khẩu:</b> <a href="'.$linkReset.'">'.$linkReset.'</a>')
                        ->send();
                    Yii::$app->session->setFlash('success','Đường dẫn đến trang cấp lại mật khẩu đã được gửi đến email của bản');
                } catch (\Exception $exception){
                    Yii::$app->session->setFlash('error','Không gửi được email, vui lòng thử lại sau ít phút');
                    $modelUser->removePasswordResetToken();
                    $modelUser->save();

                }
            }
        }

        return $this->render('quen-mat-khau',['model'=>$model]);
    }

    public function actionResetpassword($paswordtoken,$username)
    {
        $modelUser=User::findOne([
            'username'=>$username,
            'password_reset_token'=>$paswordtoken
        ]);
        if(!$modelUser){
            throw new NotFoundHttpException('Không có thông tin của chủ thể để đặt lại mật khẩu.');
        } else {
            $model = new ResetPasswordForm();
            if($model->load(Yii::$app->request->post()) && $model->validate()){
                $user=$modelUser;
                $user->setPassword($model->newPassword);
                $user->removePasswordResetToken();
                $user->save();
                Yii::$app->session->setFlash('success','Mật khẩu đã được thiết lập lại thành công');
                return $this->redirect('/site/login');
            }
            return $this->render('password-reset',[
                'model'=>$model
            ]);
        }
    }
}
