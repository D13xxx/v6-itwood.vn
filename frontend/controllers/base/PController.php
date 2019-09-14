<?php

namespace frontend\controllers\base;

use common\models\RegLoRungTrong;
use Yii;
use yii\httpclient\Client;
use yii\web\Controller;
//use common\models\RegChuThe;
use yii\web\NotFoundHttpException;

class PController extends Controller
{
	public $layout = '@app/views/layouts/private_main';
	public $regChuTheId=null;
	public $regLoaiChuTheID =null;
	public function init(){
		$this->regChuTheId= Yii::$app->session->get('reg_chu_the_id');
		$this->regLoaiChuTheID = Yii::$app->session->get('reg_loai_chu_the_id');
		if($this->regChuTheId==null){
//			Yii::$app->session->set('last_url',Yii::$app->request->url);
			return $this->redirect(["/site/login"]);
		}
	}
	protected function findCurrentRegChuTheModel()
    {		
		if (($model = RegChuThe::findOne($this->regChuTheId)) !== null) {
			return $model;
		}
	
        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }

    public static function checkLoRungFormis($tieukhu,$khoanh,$lo,$maxa)
    {
        $client = new Client();
        $url = "http://maps.vnforest.gov.vn:802/geoserver/download/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=%20download:dulieu2017&maxFeatures=50&CQL_FILTER=tieukhu=%27".$tieukhu."%27%20AND%20khoanh=%27".$khoanh."%27%20and%20malo=%27$lo%%2720AND%20maxa=%27".$maxa."%27&outputFormat=application%2Fjson";
        $res = $client->createRequest()->setMethod('GET')->setUrl($url)->send();
        if($res->isOk){
            $tam= $res->data;
//            print_r($tam); exit();
            if ($tam['totalFeatures'] <= 0){
                return $ketQua = 0;
            }
            if($tam['totalFeatures'] >= 1){
                return $ketQua =1 ;
            }
        } else {
            return $ketQua=2;
        }
    }

    public static function checkLoRungItwood($tieukhu,$khoanh,$lo,$maxa)
    {
        $kiemTra = RegLoRungTrong::find()->where([
            'and',
            ['tieu_khu'=>$tieukhu],
            ['khoanh'=>$khoanh],
            ['lo'=>$lo],
            ['trang_thai_id'=>RegLoRungTrong::TT_DA_DUYET]
        ])->count();
        if($kiemTra > 0){
            return $ketQua =1;
        } else {
            return $ketQua=0;
        }
    }


}
