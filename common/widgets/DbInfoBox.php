<?php

namespace common\widgets;

use backend\models\ChuSoHuu;
use backend\models\KieuTrongRung;
use common\models\RegChuThe;
use common\models\RegHoSoGo;
use common\models\RegLoRungTrong;
use common\models\User;
use Yii;
use yii\base\Widget;

/**
 * Class DbRegChuThe
 * Return a text block content stored in db
 * @package common\widgets\RegChuThe
 */
class DbInfoBox extends Widget
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
    public function run()
    {
        $countChuThe = RegChuThe::find()->count();
        $countLoRung = RegLoRungTrong::find()->count();
        $countUser = User::find()->count();
        $countHoSoGo = RegHoSoGo::find()->where(['trang_thai_id'=>1])->count();

        $cacheKey = [
			RegLoRungTrong::class,
        ];
        $content = Yii::$app->cache->get($cacheKey);
        if (!$content) {
             $content='<div class="row">';
                 $content.='<div class="col-sm-3">';
                    $content .='<div class="info-box">';
                         $content .='<span class="info-box-icon bg-light-blue"><i class="fa fa-users"></i></span>';
                         $content .='<div class="info-box-content text-center">';
                             $content .='<span class="info-box-text">'. Yii::t('frontend','Chủ thể').'</span>';
                             $content .='<span class="info-box-number">'.$countChuThe.'</span>';
                         $content .='</div>';
                     $content .='</div>';
                 $content .='</div>';
                 $content.='<div class="col-sm-3">';
                    $content .='<div class="info-box">';
                         $content .='<span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>';
                         $content .='<div class="info-box-content text-center">';
                             $content .='<span class="info-box-text">'.Yii::t('frontend','Người dùng').'</span>';
                             $content .='<span class="info-box-number">'.$countUser.'</span>';
                         $content .='</div>';
                     $content .='</div>';
                 $content .='</div>';
                 $content.='<div class="col-sm-3">';
                    $content .='<div class="info-box">';
                         $content .='<span class="info-box-icon bg-blue"><i class="fa fa-star-o"></i></span>';
                         $content .='<div class="info-box-content text-center">';
                             $content .='<span class="info-box-text">'. Yii::t('frontend','lô rừng trồng').'</span>';
                             $content .='<span class="info-box-number">'.$countLoRung.'</span>';
                         $content .='</div>';
                     $content .='</div>';
                 $content .='</div>';
                 $content.='<div class="col-sm-3">';
                    $content .='<div class="info-box">';
                         $content .='<span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>';
                         $content .='<div class="info-box-content text-center">';
                             $content .='<span class="info-box-text">'. Yii::t('frontend','Hồ so gỗ').'</span>';
                             $content .='<span class="info-box-number">'.$countHoSoGo.'</span>';
                         $content .='</div>';
                     $content .='</div>';
                 $content .='</div>';
             $content .='</div>';

            Yii::$app->cache->set($cacheKey, $content, 60 * 60 * 24);
        }
        return $content;
    }
}
