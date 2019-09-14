<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/15/2019
 * Time: 2:20 PM
 */

namespace frontend\controllers;

use common\models\RegChuTheHoGiaDinh;
use common\models\RegChuTheToChuc;
use common\models\RegHoSoGo;
use common\models\RegHoSoXinKhaiThac;
use common\models\RegLoRung;
use Yii;
use yii\web\Controller;


class TraceController extends Controller
{

    public function actionScan($q)
    {
        $chuTheHGD = RegChuTheHoGiaDinh::find()->where(['and',['ma'=>$q],['trang_thai_id'=>RegChuTheHoGiaDinh::TT_ACTIVE]]);
        $chuTheToChuc = RegChuTheToChuc::find()->where(['and',['ma'=>$q],['trang_thai_id'=>RegChuTheToChuc::TT_ACTIVE]]);
        $loRung = RegLoRung::find()->where(['and',['ma'=>$q],['trang_thai_id'=>RegLoRung::TT_RUNGDUOCDUYET]]);
        $HoSoDangKyKhaiThac = RegHoSoXinKhaiThac::find()->where(['and',['ma'=>$q],['or',['trang_thai_id'=>RegHoSoXinKhaiThac::TT_HOSO_DUOCDUYET],['trang_thai_id'=>RegHoSoXinKhaiThac::TT_HOSO_DACHUYENDOI]]]);
        $hoSoGo = RegHoSoGo::find()->where(['and',['ma'=>$q],['or',['trang_thai_id'=>RegHoSoGo::TT_HSG_DUOCDUYET],['trang_thai_id'=>RegHoSoGo::TT_HSG_CHUYENDOI]]]);

        if($chuTheHGD->count()>0){
            $modelHGD=$chuTheHGD->one();
            return $this->redirect(['/truy-xuat/view-ho-gia-dinh','id'=>$modelHGD->id]);
        }
        elseif($chuTheToChuc->count()>0){
            $modelTC=$chuTheToChuc->one();
            return $this->redirect(['/truy-xuat/view-to-chuc','id'=>$modelTC->id]);
        }
        elseif($loRung->count()>0){
            $modelLR=$loRung->one();
            return $this->redirect(['/truy-xuat/view-lo-rung','id'=>$modelLR->id]);
        }
        elseif($HoSoDangKyKhaiThac->count()>0){
            $modelHSDK=$HoSoDangKyKhaiThac->one();
            return $this->redirect(['/truy-xuat/view-dang-ky-khai-thac','id'=>$modelHSDK->id]);
        }
        elseif($hoSoGo->count()>0){
            $modelHSG=$hoSoGo->one();
            return $this->redirect(['/truy-xuat/view-ho-so-go','id'=>$modelHSG->id]);
        } else {
            return $this->redirect(['/truy-xuat']);
        }
    }

}