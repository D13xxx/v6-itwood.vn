<?php

namespace frontend\modules\HoSoXinKhaiThac\controllers;

use common\models\Dungchung;
use common\models\RegHoSoXinKhaiThac;
use common\models\RegHoSoXinKhaiThacTuanThu;
use common\models\RegLoRung;
use frontend\controllers\base\PController;
use Yii;
use common\models\RegHoSoXinKhaiThacBkls;
use common\models\searchs\RegHoSoXinKhaiThacBklsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 */
class ChiTietHoSoController extends PController
{

    public function actionCreate($hoSoKhaiThacID)
    {
        $model = new RegHoSoXinKhaiThacBkls();
        $modelHoSoDangKyKhaiThac = $this->findHoSoKhaiThac($hoSoKhaiThacID);

        if(Yii::$app->request->post() && $model->load(Yii::$app->request->post())){
            $dataPost = Yii::$app->request->post();

            /*
             * Kiểm tra dữ liệu nhập vào
             * Nếu Lô rừng đã có trong Hồ sơ đăng ký khai thác thì
             * Kiểm tra xem tổng diện tích nhập vào có vươt quá tổng diện tích của lô rừng hay không?
             * Các thông tin nhập vào có trùng lặp với thông tin đã có hay không?
             * Nếu trùng thì
             * Số cây trồng mới = số cây trồng nhập vào + số cây trồng đã có;
             * Sản lượng dự kiến = Sản lượng dự kiến nhập vào + Sản lượng dự kiến đã có;
             * Diện tích khai thác = Diện tích khai thác nhập vào + Diện tích khai thác đã có;
             * Cập nhật dữ liệu cho bảng kê lâm sản và thoát ra
             * Nếu không trùng thì thêm dòng mới cho Bảng kê lâm sản;
             * Kiểm tra tổng diện tích khai thác đã khai với tổng diện tích các lô rừng thêm vào
             * Nếu tổng diện tích của lô rừng thêm vào > tổng diện tích khai thác thì báo lỗi.
             */

            $loRungMoi = $model->reg_lo_rung_id;
            $countLoRung = RegHoSoXinKhaiThacBkls::find()->where(['and',['reg_lo_rung_id'=>$loRungMoi],['reg_ho_so_xin_khai_thac_id'=>$hoSoKhaiThacID]]);

            //Kiểm tra tổng diện tích đăng ký khai thác với tổng diện tích các lô rừng nhập vào
//            $tongDienTichDaCo = RegHoSoXinKhaiThacBkls::TongDienTichKhaiThac($hoSoKhaiThacID);
//            $modelHoSoXinKhaiThac = $this->findHoSoKhaiThac($hoSoKhaiThacID);
//            if(floatval($modelHoSoXinKhaiThac->dien_tich_khai_thac)< floatval($tongDienTichDaCo)){
//                Yii::$app->session->setFlash('error',Yii::t('frontend','Tổng diện tích các lô rừng lớn hơn tổng diện tích khai thác. Vui lòng kiểm tra lại.'));
//                return $this->render('create', [
//                    'model' => $model,
//                    'modelHoSoDangKyKhaiThac'=>$modelHoSoDangKyKhaiThac
//                ]);
//            }

            if($countLoRung->count()>0){
                $bklsKhaiThac = $countLoRung->one();
                $dienTichCu = $bklsKhaiThac->dien_tich_khai_thac;
                $phuongThucKTCu = $bklsKhaiThac->phuong_thuc_khai_thac_id;
                $modelLoRung = $this->findLoRung($loRungMoi);
                $tongDienTich = floatval($model->dien_tich_khai_thac)+floatval($dienTichCu);
                if($tongDienTich > floatval($modelLoRung->dien_tich)){
                    Yii::$app->session->setFlash('error',Yii::t('frontend','Diện tích khai thác lơn hơn diện tích lô rừng, vui lòng kiểm tra lại'));
                    return $this->render('create', [
                        'model' => $model,
                        'modelHoSoDangKyKhaiThac'=>$modelHoSoDangKyKhaiThac
                    ]);
                }
                if($model->loai_cay_trong_id == $bklsKhaiThac->loai_cay_trong_id && $model->phuong_thuc_khai_thac_id==$phuongThucKTCu && $model->tuoi_rung_khai_thac == $bklsKhaiThac->tuoi_rung_khai_thac && $model->d13_cay_pho_bien == $bklsKhaiThac->d13_cay_pho_bien){
                    $modelBKLSUpdate = $this->findModel($bklsKhaiThac->id);
                    $modelBKLSUpdate->dien_tich_khai_thac = $tongDienTich;
                    $modelBKLSUpdate->san_luong_du_kien = $bklsKhaiThac->san_luong_du_kien+$model->san_luong_du_kien;
                    $modelBKLSUpdate->so_cay_hien_tai = $bklsKhaiThac->so_cay_hien_tai+$model->so_cay_hien_tai;
                    if($model->phuong_an_bao_ve_rung==''||$model->phuong_an_bao_ve_rung==null){
                        $modelBKLSUpdate->phuong_an_bao_ve_rung = $bklsKhaiThac->phuong_an_bao_ve_rung;
                    }
                    $modelBKLSUpdate->save();
                    Yii::$app->session->setFlash('success',Yii::t('frontend','Thêm thông tin đăng ký khai thác thành công'));
                    return $this->redirect(['/ho-so-xin-khai-thac/ho-so-xin-khai-thac/view','id'=>$hoSoKhaiThacID]);
                } else {
                    foreach ($dataPost['giaTris'] as $key => $giaTriTuanThu){
                        $modelTuanThu= new RegHoSoXinKhaiThacTuanThu();
                        $modelTuanThu->reg_lo_rung_id = $model->reg_lo_rung_id;
                        $modelTuanThu->reg_trach_nhiem_tuan_thu_id = $key;
                        $modelTuanThu->gia_tri = $giaTriTuanThu;
                        if($giaTriTuanThu!=0){
                            $fileUploads = UploadedFile::getInstancesByName('file_dinh_kem['.$key.']');
                            $tepDinhKem=[];
                            foreach ($fileUploads as $fileUpload){
                                if(!file_exists(Yii::getAlias('@images').'/uploads/trach-nhiem-tuan-thu')){
                                    mkdir(Yii::getAlias('@images').'/uploads/trach-nhiem-tuan-thu',0777,true);
                                }

                                Yii::$app->params['uploads']=Yii::getAlias('@images').'/uploads/trach-nhiem-tuan-thu/';
                                $moRong = $fileUpload->extension;
                                $tenFile = $fileUpload->baseName;
                                $path=Yii::$app->params['uploads'].uniqid().'-'.Dungchung::TaoMaSlug($tenFile).'.'.$moRong;
                                $tepDinhKem[]=uniqid().'-'.Dungchung::TaoMaSlug($tenFile).'.'.$moRong;
                                $fileUpload->saveAs($path);
                            }

                            $modelTuanThu->file_dinh_kem=implode(';',$tepDinhKem);
                        }
                        $modelTuanThu->reg_ho_so_xin_khai_thac_id= $hoSoKhaiThacID;
                        $modelTuanThu->save();
                    }

                    //Ssave to tabel RegHoSoXinKhaiThacBkls
//                    $model->nam_trong = date("Y",strtotime($model->nam_trong));
                    $model->reg_ho_so_xin_khai_thac_id=$hoSoKhaiThacID;
                    $model->trang_thai_id=RegHoSoXinKhaiThacBkls::TT_BKLS_MOI;
                    if($model->save()){
                        $tongDienTichDaCo = RegHoSoXinKhaiThacBkls::TongDienTichKhaiThac($hoSoKhaiThacID);
                        $modelHoSoDangKyKhaiThac->dien_tich_khai_thac = $tongDienTichDaCo;
                        $modelHoSoDangKyKhaiThac->save();
                        Yii::$app->session->setFlash('success',Yii::t('frontend','Thêm thông tin đăng ký khai thác thành công'));
                        return $this->redirect(['/ho-so-xin-khai-thac/ho-so-xin-khai-thac/view','id'=>$hoSoKhaiThacID]);
                    }
                }
            } else {
                $modelLoRung = $this->findLoRung($model->reg_lo_rung_id);
                if($modelLoRung->dien_tich < $model->dien_tich_khai_thac){
                    Yii::$app->session->setFlash('error',Yii::t('frontend','Diện tích khai thác lơn hơn diện tích lô rừng, vui lòng kiểm tra lại'));
                    return $this->render('create', [
                        'model' => $model,
                        'modelHoSoDangKyKhaiThac'=>$modelHoSoDangKyKhaiThac
                    ]);
                }

                //Save to table: RegHoSoXinKhaiThacTuanThu
                foreach ($dataPost['giaTris'] as $key => $giaTriTuanThu){
                    $modelTuanThu= new RegHoSoXinKhaiThacTuanThu();
                    $modelTuanThu->reg_lo_rung_id = $model->reg_lo_rung_id;
                    $modelTuanThu->reg_trach_nhiem_tuan_thu_id = $key;
                    $modelTuanThu->gia_tri = $giaTriTuanThu;
                    if($giaTriTuanThu!=0){
                        $fileUploads = UploadedFile::getInstancesByName('file_dinh_kem['.$key.']');
                        $tepDinhKem=[];
                        foreach ($fileUploads as $fileUpload){
                            if(!file_exists(Yii::getAlias('@images').'/uploads/trach-nhiem-tuan-thu')){
                                mkdir(Yii::getAlias('@images').'/uploads/trach-nhiem-tuan-thu',0777,true);
                            }

                            Yii::$app->params['uploads']=Yii::getAlias('@images').'/uploads/trach-nhiem-tuan-thu/';
                            $moRong = $fileUpload->extension;
                            $tenFile = $fileUpload->baseName;
                            $path=Yii::$app->params['uploads'].uniqid().'-'.Dungchung::TaoMaSlug($tenFile).'.'.$moRong;
                            $tepDinhKem[]=uniqid().'-'.Dungchung::TaoMaSlug($tenFile).'.'.$moRong;
                            $fileUpload->saveAs($path);
                        }

                        $modelTuanThu->file_dinh_kem=implode(';',$tepDinhKem);
                    }
                    $modelTuanThu->reg_ho_so_xin_khai_thac_id= $hoSoKhaiThacID;
                    $modelTuanThu->save();
                }

                //Ssave to tabel RegHoSoXinKhaiThacBkls
//                $model->nam_trong = date("Y",strtotime($model->nam_trong));
                $model->reg_ho_so_xin_khai_thac_id=$hoSoKhaiThacID;
                $model->trang_thai_id=1;
                if($model->save()){
                    $tongDienTichDaCo = RegHoSoXinKhaiThacBkls::TongDienTichKhaiThac($hoSoKhaiThacID);
                    $modelHoSoDangKyKhaiThac->dien_tich_khai_thac = $tongDienTichDaCo;
                    $modelHoSoDangKyKhaiThac->save();
                    Yii::$app->session->setFlash('success',Yii::t('frontend','Thêm thông tin đăng ký khai thác thành công'));
                    return $this->redirect(['/ho-so-xin-khai-thac/ho-so-xin-khai-thac/view','id'=>$hoSoKhaiThacID]);
                }
            }

        }

        return $this->render('create', [
            'model' => $model,
            'modelHoSoDangKyKhaiThac'=>$modelHoSoDangKyKhaiThac
        ]);
    }

    private function checkLoRung($id)
    {
        $modelLoRung = $this->findLoRung($id);

    }

    private function findLoRung($id){
        if (($model = RegLoRung::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }

    protected function findModel($id)
    {
        if (($model = RegHoSoXinKhaiThacBkls::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }

    protected function findHoSoKhaiThac($id)
    {
        if (($model = RegHoSoXinKhaiThac::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }
}
