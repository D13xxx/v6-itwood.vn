<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/21/2019
 * Time: 4:45 PM
 */

namespace frontend\controllers;

use common\models\Dungchung;
use common\models\QuanHuyen;
use common\models\RegChuTheHoGiaDinh;
use common\models\RegChuTheToChuc;
use common\models\XaPhuong;
use Yii;
use yii\base\DynamicModel;
use yii\web\Controller;
use yii\web\UploadedFile;

class DangKyController extends Controller
{

    public function actionIndex()
    {
        $model = new DynamicModel(['loai_chu_the']);
        $model->addRule(['loai_chu_the'],'integer');
        $model->addRule(['loai_chu_the'],'required');

        return $this->render('index',[
            'model'=>$model,
        ]);
    }

    public function actionRegToChuc()
    {
        $modelToChuc = new RegChuTheToChuc();

        if($modelToChuc->load(Yii::$app->request->post())){
            if($this->checkMST($modelToChuc->giay_dang_ky_kd,$modelToChuc->ma_so_thue)){
                Yii::$app->session->setFlash('error','Giấy chứng nhận / Mã số thuế đã tồn tại. Vui lòng kiểm tra lại');
                return $this->redirect('/dang-ky');
            }
            $tepDinhKems= UploadedFile::getInstances($modelToChuc,'file_dinh_kem');
            $fileDinhKem=[];
            foreach ($tepDinhKems as $temDinhKem)
            {
                if(!file_exists(Yii::getAlias('@images').'/uploads/chu-the/to-chuc')){
                    mkdir(Yii::getAlias('@images').'/uploads/chu-the/to-chuc',0777,true);
                }

                Yii::$app->params['uploads']=Yii::getAlias('@images').'/uploads/chu-the/to-chuc/';
                $path=Yii::$app->params['uploads'].$temDinhKem->name;
                $fileDinhKem[]=$temDinhKem->name;
                $temDinhKem->saveAs($path);
            }
            $modelToChuc->file_dinh_kem=implode(';',$fileDinhKem);
            $modelToChuc->loai_hinh_hoat_dong_id = implode(';',$modelToChuc->loai_hinh_hoat_dong_id_array);
            $modelToChuc->ma=uniqid();
            $modelToChuc->ngay_cap = Dungchung::convert_to_date($modelToChuc->ngay_cap,'datetime');
            $modelToChuc->trang_thai_id= RegChuTheToChuc::TT_NEWREG;
            $modelToChuc->ngay_tao = date("Y-m-d H:i:s");
            if($modelToChuc->save()){
                Yii::$app->session->setFlash('success',Yii::t('backend','Thêm mới thành công'));
                return $this->render('thanh-cong');
            }
        }

        return $this->renderAjax('_form',[
            'modelToChuc'=>$modelToChuc
        ]);
    }

    public function actionRegHoGiaDinh()
    {
        $model = new RegChuTheHoGiaDinh();

        if($model->load(Yii::$app->request->post())){
            if($this->checkCMTND($model->so_cmtnd)){
                Yii::$app->session->setFlash('error','Số chứng minh thư / Số thẻ căn cước đã tồn tại. Vui lòng kiểm tra lại');
                return $this->redirect('/dang-ky');
            }
            $tepDinhKems= UploadedFile::getInstances($model,'file_dinh_kem');
            $fileDinhKem=[];
            foreach ($tepDinhKems as $temDinhKem)
            {
                if(!file_exists(Yii::getAlias('@images').'/uploads/chu-the/ho-gia-dinh')){
                    mkdir(Yii::getAlias('@images').'/uploads/chu-the/ho-gia-dinh',0777,true);
                }

                Yii::$app->params['uploads']=Yii::getAlias('@images').'/uploads/chu-the/ho-gia-dinh/';
                $path=Yii::$app->params['uploads'].$temDinhKem->name;
                $fileDinhKem[]=$temDinhKem->name;
                $temDinhKem->saveAs($path);
            }
            $model->file_dinh_kem=implode(';',$fileDinhKem);
            $model->loai_hinh_hoat_dong_id = implode(';',$model->loai_hinh_hoat_dong_id_array);
            $model->ma=uniqid();
            $model->ngay_cap = Dungchung::convert_to_date($model->ngay_cap,'datetime');
            $model->trang_thai_id= RegChuTheHoGiaDinh::TT_NEWREG;
            $model->ngay_tao = date("Y-m-d H:i:s");
            if($model->save()){
                Yii::$app->session->setFlash('success',Yii::t('backend','Thêm mới thành công'));
                return $this->render('thanh-cong');
            }
        }

        return $this->renderAjax('_form',[
            'modelHoGiaDinh'=>$model,
        ]);
    }

    public function actionDanhSachQuanHuyen($id)
    {
        $rows= QuanHuyen::find()->where(['tinh_thanh_id'=>$id])->active()->all();
        if(count($rows)>0){
            echo "<option disabled selected hidden>".Yii::t('frontend','Lựa chọn Quận huyện')."</option>";
            foreach($rows as $row){
                echo "<option value='$row->id'>$row->ten</option>";
            }
        }
    }

    public function actionDanhSachXaPhuong($id)
    {
        $rows= XaPhuong::find()->where(['quan_huyen_id'=>$id])->active()->all();
        if(count($rows)>0){
            echo "<option disabled selected hidden>".Yii::t('frontend','Lựa chọn Xã phường')."</option>";
            foreach($rows as $row){
                echo "<option value='$row->id'>$row->ten</option>";
            }
        }
    }

    private function checkCMTND($soCMTND){
        $count = RegChuTheHoGiaDinh::find()->where(['and',['so_cmtnd'=>$soCMTND],['trang_thai_id'=>RegChuTheHoGiaDinh::TT_ACTIVE]])->count();
        if($count > 0){
            return true;
        }
        return false;
    }

    private function checkMST($soDKKD,$MST){
        $count = RegChuTheToChuc::find()->where(['and',['or',['giay_dang_ky_kd'=>$soDKKD],['ma_so_thue'=>$MST]],['trang_thai_id'=>RegChuTheToChuc::TT_ACTIVE]])->count();
        if($count > 0){
            return true;
        }
        return false;
    }
}