<?php

namespace common\widgets;

use backend\models\ChuSoHuu;
use backend\models\KieuTrongRung;
use common\models\RegChuThe;
use common\models\RegLoRungTrong;
use common\models\User;
use Yii;
use yii\base\Widget;
use yii\widgets\DetailView;

/**
 * Class DbRegChuThe
 * Return a text block content stored in db
 * @package common\widgets\RegChuThe
 */
class DbThongTinChuThe extends Widget
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
    public $chuTheID;

    public function run()
    {

        $cacheKey = [
			\common\models\ChuSoHuu::class,
        ];
        $content = Yii::$app->cache->get($cacheKey);

        $model = RegChuThe::find()->where(['id'=>$this->chuTheID])->one();
        if (!$content) {
            $content = DetailView::widget([
                'model'=>$model,
                'attributes'=>[
                    'ma',
                    'ten',
                    [
                    'attribute'=>'loai_chu_the_id',
                    'value'=>function($data)
                    {
                        return RegChuThe::LOAI_CHU_THE_ARRAY[(int)$data->loai_chu_the_id];//.$data->loai_chu_the_id;
                    }
                ],
                [
                    'attribute'=>'loai_hinh_hoat_dong_id',
                    'format'=>'html',
                    'value'=>function($data)
                    {	if(strlen($data->loai_hinh_hoat_dong_id)>=1){
                        $arrayItems=explode(';',$data->loai_hinh_hoat_dong_id);
                        $tenChuThe='';
                        foreach ($arrayItems as $item){
                            $tenChuThe .= '<span class="badge">'.RegChuThe::LOAI_HINH_HOAT_DONG_ARRAY[$item]."</span>";//$tenChuThe.$LoaiHinhHoatDong->ten.'<br>';
                        }
                        return $tenChuThe;
                    }
                    }
                ],
                [
                    'attribute'=>'trang_thai_id',
                    'format'=>'html',
                    'value'=>function($data)
                    {
                        return '<span class="label label-'.RegChuThe::TRANG_THAI_COLOR_ARRAY[(int)$data->trang_thai_id].'">'.RegChuThe::TRANG_THAI_ARRAY[(int)$data->trang_thai_id].'</span>';
                    },
                ],

            ]
            ]);

            Yii::$app->cache->set($cacheKey, $content, 60 * 60 * 24);
        }
        return $content;
    }
}
