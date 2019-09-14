<?php

namespace common\widgets;

use backend\models\KieuTrongRung;
use common\models\RegChuThe;
use common\models\RegLoRungTrong;
use Yii;
use yii\base\Widget;

/**
 * Class DbRegChuThe
 * Return a text block content stored in db
 * @package common\widgets\RegChuThe
 */
class DbLoRungTrong extends Widget
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
        if($this->taiKhoanID!='' || $this->taiKhoanID!=null){
            $chuThe = RegChuThe::find()->where(['user_id'=>$this->taiKhoanID])->all();
            $countLoRung = 0;
            $countRungTrongPhongHo = 0;
            $countRungTrongSanXuat = 0;
            $countLoRungTrongDangChoDuyet = 0;
            $countLoRungTrongDaDuyet =0;
            foreach ($chuThe as $key => $value){
                $slLoRung = RegLoRungTrong::find()->where(['reg_chu_the_id'=>$value->id])->count();
                $slRungTrongPhongHo = RegLoRungTrong::find()->where(['and',['loai_rung_id'=>0],['reg_chu_the_id'=>$value->id]])->count();
                $slRungTrongSanXuat = RegLoRungTrong::find()->where(['and',['loai_rung_id'=>1],['reg_chu_the_id'=>$value->id]])->count();

                $slRungChoDuyet = RegLoRungTrong::find()->where(['and',['trang_thai_id'=>RegLoRungTrong::TT_YEU_CAU_DUYET],['reg_chu_the_id'=>$value->id]])->count();
                $slRungDaDuyet = RegLoRungTrong::find()->where(['and',['trang_thai_id'=>RegLoRungTrong::TT_DA_DUYET],['reg_chu_the_id'=>$value->id]])->count();

                $countLoRung = $countLoRung + $slLoRung;
                $countRungTrongSanXuat= $countRungTrongSanXuat + $slRungTrongSanXuat;
                $countRungTrongPhongHo = $countRungTrongPhongHo + $slRungTrongPhongHo;
                $countLoRungTrongDangChoDuyet = $countLoRungTrongDangChoDuyet + $slRungChoDuyet;
                $countLoRungTrongDaDuyet = $countLoRungTrongDaDuyet + $slRungDaDuyet;
            }
//            $countLoRung = RegLoRungTrong::find()->count();
//            $countRungTrongPhongHo = RegLoRungTrong::find()->where(['loai_rung_id'=>0])->count();
//            $countRungTrongSanXuat = RegLoRungTrong::find()->where(['loai_rung_id'=>1])->count();
        } else {
            $countLoRung = RegLoRungTrong::find()->count();
            $countRungTrongPhongHo = RegLoRungTrong::find()->where(['loai_rung_id'=>0])->count();
            $countRungTrongSanXuat = RegLoRungTrong::find()->where(['loai_rung_id'=>1])->count();
            $countLoRungTrongDaDuyet = RegLoRungTrong::find()->where(['trang_thai_id'=>RegLoRungTrong::TT_DA_DUYET])->count();
            $countLoRungTrongDangChoDuyet = RegLoRungTrong::find()->where(['trang_thai_id'=>RegLoRungTrong::TT_YEU_CAU_DUYET])->count();
        }

        $cacheKey = [
			RegLoRungTrong::class,
        ];
        $content = Yii::$app->cache->get($cacheKey);
        if (!$content) {
            $content ='<table class="table table-striped table-responsive"><tr><th>'. Yii::t('frontend','Thống kê số liệu').'</th><th class="text-center">'. Yii::t('frontend','Số lượng').'</th></tr>';
            $content .='<tr><td> '. Yii::t('frontend','Số lượng lô rừng').'</td><td class="text-center"><span class="badge ">'.$countLoRung.'</span></td></tr>';
            $content .='<tr><td> '. Yii::t('frontend','Số lượng lô rừng trồng phòng hộ').'</td><td class="text-center"><span class="badge ">'.$countRungTrongPhongHo.'</span></td></tr>';
            $content .='<tr><td> '. Yii::t('frontend','Số lượng lô rừng trồng sản xuất').'</td><td class="text-center"><span class="badge">'.$countRungTrongSanXuat.'</span></td></tr>';
            $content .='<tr><td> '. Yii::t('frontend','Số lượng lô rừng đã duyệt').'</td><td class="text-center"><span class="badge">'.$countLoRungTrongDaDuyet.'</span></td></tr>';
            $content .='<tr><td> '. Yii::t('frontend','Số lượng lô rừng chờ duỵet').'</td><td class="text-center"><span class="badge">'.$countLoRungTrongDangChoDuyet.'</span></td></tr>';
			$content .='</table>';
                Yii::$app->cache->set($cacheKey, $content, 60 * 60 * 24);
        }
        return $content;
    }
}
