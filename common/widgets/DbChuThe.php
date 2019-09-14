<?php

namespace common\widgets;

use common\models\RegChuThe;
use common\models\RegChuTheHoGiaDinh;
use common\models\RegChuTheToChuc;
use common\models\RegHoGiaDinh;
use common\models\RegLoRungTrong;
use common\models\RegToChucDoanhNghiep;
use Yii;
use yii\base\Widget;

/**
 * Class DbRegChuThe
 * Return a text block content stored in db
 * @package common\widgets\RegChuThe
 */
class DbChuThe extends Widget
{
    /**
     * @var string text block key
     */
//	public $title='Chủ thể';
//    public $loai_chu_the_id;//Hộ gia đình:1, Doanh nghiệp 0;
//	public $trang_thai_id;//Đăng ký, Đề nghị xác nhận, Đã duyệt;
	
//	public $totalRec=5;//Số lượng bản ghi;
    /**
     * @return string
     */
    public $taiKhoanID;

    public function run()
    {
        if($this->taiKhoanID!='' || $this->taiKhoanID!=null)
        {
            $countChuThe = RegChuThe::find()->where(['user_id'=>$this->taiKhoanID])->count();
            $countChuTheMoi = RegChuThe::find()->where(['and',['trang_thai_id'=>1],['user_id'=>$this->taiKhoanID]])->count();
            $countChuTheDenghiDuyet = RegChuThe::find()->where(['and',['trang_thai_id'=>2],['user_id'=>$this->taiKhoanID]])->count();
            $countChuTheBiTraLai = RegChuThe::find()->where(['and',['trang_thai_id'=>3],['user_id'=>$this->taiKhoanID]])->count();
            $countChuTheDaDuyet = RegChuThe::find()->where(['and',['trang_thai_id'=>4],['user_id'=>$this->taiKhoanID]])->count();

            $regChuThe = RegChuThe::find()->where(['user_id'=>$this->taiKhoanID])->all();
            $countHoGiaDinh = 0;
            $countToChucDoanhNghiep =0;
            foreach ($regChuThe as $key => $value){
                $hoGiaDinh = RegHoGiaDinh::find()->where(['reg_chu_the_id'=>$value->id])->count();
                $toChucDoanhNghiep = RegToChucDoanhNghiep::find()->where(['reg_chu_the_id'=>$value->id])->count();
                $countHoGiaDinh = $countHoGiaDinh + $hoGiaDinh;
                $countToChucDoanhNghiep = $countToChucDoanhNghiep + $toChucDoanhNghiep;
            }

//            $countHoGiaDinh =RegHoGiaDinh::find()->count();
//            $countToChucDoanhNghiep =RegToChucDoanhNghiep::find()->count();
        } else {
            $countHGDMoi= RegChuTheHoGiaDinh::find()->where(['trang_thai_id'=>3])->count();
            $countTCMoi= RegChuTheToChuc::find()->where(['trang_thai_id'=>3])->count();
            $countChuTheMoi = $countHGDMoi+$countTCMoi;

            $countChuTheDenghiDuyet = 0;
            $countChuTheBiTraLai = 0;
            $countChuTheDaDuyet = 0;

            $countHoGiaDinh =RegChuTheHoGiaDinh::find()->count();
            $countToChucDoanhNghiep =RegChuTheToChuc::find()->count();
            $countChuThe = $countHoGiaDinh+$countToChucDoanhNghiep;
        }
//        $cacheKey = [
//			RegHoGiaDinh::class,
//			RegToChucDoanhNghiep::class,
//			RegChuThe::class,
//        ];
        $content = '';
        if (!$content) {
            $content ='<table class="table table-striped table-responsive"><tr><th>'. Yii::t('frontend','Thống kê sô liệu').'</th><th class="text-center">'. Yii::t('frontend','Số lượng').'</th></tr>';
            $content .='<tr><td>'. Yii::t('frontend','Số lượng chủ rừng').'</td><td class="text-center"><span class="badge ">'.$countChuThe.'</span></td></tr>';
            $content .='<tr><td>'. Yii::t('frontend','Số lượng hộ gia đình').'</td><td class="text-center"><span class="badge ">'.$countHoGiaDinh.'</span></td></tr>';
            $content .='<tr><td>'. Yii::t('frontend','Số lượng tổ chức/doanh nghiệp').'</td><td class="text-center"><span class="badge">'.$countToChucDoanhNghiep.'</span></td></tr>';
            $content .='<tr><td>'. Yii::t('frontend','Số lượng chủ thể mới').'</td><td class="text-center"><span class="badge">'.$countChuTheMoi.'</span></td></tr>';
            $content .='<tr><td>'. Yii::t('frontend','Số lượng chủ thể chưa đạt').'</td><td class="text-center"><span class="badge">'.$countChuTheBiTraLai.'</span></td></tr>';
            $content .='<tr><td>'. Yii::t('frontend','Số lượng thể đề nghị duyệt').'</td><td class="text-center"><span class="badge">'.$countChuTheDenghiDuyet.'</span></td></tr>';
            $content .='<tr><td>'. Yii::t('frontend','Số lượng chủ thể đã được duyệt').'</td><td class="text-center"><span class="badge">'.$countChuTheDaDuyet.'</span></td></tr>';
            $content .='</table>';
//                Yii::$app->cache->set($cacheKey, $content, 60 * 60 * 24);
        }
        return $content;
    }
}
