<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;
    public $username;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'],'trim'],
            [['username'],'required'],
            [['username'],'exist',
                'targetClass'=>'\common\models\User',
                'message' => 'Không tìm thấy tài khoản này.'
            ],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'Địa chỉ email không tồn tại'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username'=>Yii::t('frontend','Tài khoản đăng ký'),
            'email' => Yii::t('frontend','Email đăng ký')
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
            'username'=>$this->username
        ]);

        if (!$user) {
            return false;
        }
        
        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }


        return Yii::$app->mailer->compose()
            ->setFrom([Yii::$app->params['supportEmail'] => 'Hỗ trợ - ITWOOD'])
            ->setTo($this->email)
            ->setSubject('Đặt lại mật khẩu cho tài khoản:')
            ->setHtmlBody($user)
            ->send();
    }
}
