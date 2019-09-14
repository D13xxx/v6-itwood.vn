<?php

namespace common\widgets;

use common\models\RegChuThe;
use Yii;
use yii\base\Widget;

/**
 * Class DbRegChuThe
 * Return a text block content stored in db
 * @package common\widgets\RegChuThe
 */
class DbRegChuThe extends Widget
{
    /**
     * @var string text block key
     */
	public $title='Chủ thể'; 
    public $loai_chu_the_id;//Hộ gia đình:1, Doanh nghiệp 0; 
	public $trang_thai_id;//Đăng ký, Đề nghị xác nhận, Đã duyệt; 
	
	public $totalRec=5;//Số lượng bản ghi;
    /**
     * @return string
     */
    public function run()
    {
		$key = 'dbregchuthe_'.$this->loai_chu_the_id.$this->trang_thai_id.$this->totalRec;	
        $cacheKey = [
			RegChuThe::class,
            $key
        ];
        $content = Yii::$app->cache->get($cacheKey);
        if (!$content) {
            $models = RegChuThe::find()->where(['loai_chu_the_id' => $this->loai_chu_the_id])->all();
			//->select(['id','ten'])->where['loai_chu_the_id' => $this->loai_chu_the_id, 'status' =>$this->trang_thai_id])->limit(3)->all();
            $content ='<table><tr><th>#</th><th>'.$this->title.'</th></tr>';
			$count = 0;
			foreach($models as $model){
				$count++;
				$content .='<tr><td>'.$count.'. </td><td>'.$model->ten.'</td></tr>';
			} 
			$content .='</table>';
			
                Yii::$app->cache->set($cacheKey, $content, 60 * 60 * 24);
           
        }
        return $content;
    }
}
