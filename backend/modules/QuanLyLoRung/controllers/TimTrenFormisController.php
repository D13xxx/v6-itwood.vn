<?php

namespace backend\modules\QuanLyLoRung\controllers;

use common\models\QuanHuyen;
use common\models\RegSystemFormis;
use common\models\TinhThanh;
use common\models\XaPhuong;
use yii\base\DynamicModel;
use yii\httpclient\Client;
use yii\httpclient\JsonParser;
use Yii;

class TimTrenFormisController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new DynamicModel(['tinh_thanh_id','quan_huyen_id','xa_phuong_id']);
        $model->addRule(['tinh_thanh_id','quan_huyen_id','xa_phuong_id'],'required')
            ->addRule(['tinh_thanh_id','quan_huyen_id','xa_phuong_id'],'integer');

        $modelTimKiem = null;

        if($model->load(Yii::$app->request->post())){
            $maTinh = TinhThanh::find()->where(['id'=>$model->tinh_thanh_id])->one();
            $maQuan = QuanHuyen::find()->where(['id'=>$model->quan_huyen_id])->one();
            $maXa = XaPhuong::find()->where(['id'=>$model->xa_phuong_id])->one();
            $modelFormis = RegSystemFormis::find()->where(['and',['trang_thai_id'=>1],['id'=>4]])->one();
            $client = new Client();
            $url= $modelFormis->url.$modelFormis->bang_du_lieu."&CQL_FILTER=matinh=".urlencode($maTinh->ma)."%20AND%20mahuyen=".urlencode($maQuan->ma)."%20AND%20maxa=".urlencode($maXa->ma)."&outputFormat=application%2Fjson";
            $res = $client->createRequest()->setMethod('GET')->setUrl($url)->send();
            if($res->isOk){
                $tam = $res->data;
//                print_r($tam); exit();
                return $this->render('index',[
                    'model'=>$model,
                    'modelTimKiem'=>$tam,
                ]);
            } else {
                Yii::$app->session->setFlash('alert', [
                    'options' => ['class' => 'alert-error'],
                    'body' => Yii::t('backend','Không kết nối được với formis. Vui lòng thông báo cho quản trị viên.')
                ]);
                $tam=null;
                return $this->render('index',[
                    'model'=>$model,
                    'modelTimKiem'=>$tam,
                ]);
            }
        }

        return $this->render('index',[
            'model'=>$model,
            'modelTimKiem'=>$modelTimKiem,
        ]);
    }

}
