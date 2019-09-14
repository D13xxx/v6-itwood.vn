<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/21/2019
 * Time: 10:20 AM
 */

namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\Model;

class QuenMatKhau extends Model
{

    public $user_id;
    public $email;

    public function rules()
    {
        return [
            [['user_id'],'trim'],
            [['user_id'],'required'],
            [['user_id'],'user_existe',],

            [['email'],'trim'],
            [['email'],'required'],
            [['email'],'email'],
            [['email'],'email_existe',],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_id'=>Yii::t('frontend','Tài khoản đăng ký'),
            'email'=>Yii::t('frontend','Email đăng ký')
        ];
    }


    public function user_existe($attribute,$params){
        $userCount = User::find()->where(['username'=>$this->$attribute])->count();
        if($userCount>0){
            return true;
        } else {
            $this->addError($attribute,Yii::t('frontend','Không tồn tại tài khoản này'));
            return false;
        }
        return false;
    }

    public function email_existe($attribute,$params){
        $userCount = User::find()->where(['email'=>$this->$attribute])->count();
        if($userCount>0){
            return true;
        } else {
            $this->addError($attribute,Yii::t('frontend','Không tồn tại email này'));
            return false;
        }
        return false;
    }
}