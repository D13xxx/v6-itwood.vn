<?php

namespace common\widgets;

use common\models\RegChuTheToChuc;
use Yii;
use yii\base\Widget;

/**
 * Class DbRegChuThe
 * Return a text block content stored in db
 * @package common\widgets\RegChuThe
 */
class DbHighChartsToChucDoanhNghiep extends Widget
{
    public function run()
    {
        $reChuTheCounts = RegChuTheToChuc::find()
            ->select(['trang_thai_id','COUNT(*) AS cnt'])
            ->groupBy(['trang_thai_id'])
            ->asArray()
            ->all();
        $calCulate=array();
        $toTal = 0;
        $data = array();

        foreach($reChuTheCounts as $item){
            $toTal  += $item['cnt'];
            $calCulate[$item['trang_thai_id']] = $item['cnt'];
        }
        if($toTal>0){
            foreach($reChuTheCounts as $item){
                $data[] = [
                    'name'=>RegChuTheToChuc::TRANG_THAI_ARRAY[$item['trang_thai_id']].$item['cnt'].'/'.$toTal,
                    'y'=>round($calCulate[$item['trang_thai_id']]/$toTal*100,2),
                    'sliced'=>true,
                ];
            }
        }

        $content = '';
        if (!$content) {

            $content.=\dosamigos\highcharts\HighCharts::widget([
                'clientOptions' => [
                    'credits' => [
                        'enabled' => false
                    ],
                    'exporting' => [
                        'enabled' => false
                    ],
                    'chart' => [
                        'type' => 'pie'
                    ],
                    'title'=> [
                        'text'=>''
                    ],
                    'tooltip'=> [
                        'pointFormat'=>'<b>{point.percentage:.1f}%</b>'
                    ],
                    'plotOptions'=> [
                        'pie'=>[
                            'allowPointSelect'=> true,
                            'cursor'=> 'pointer',
                            'dataLabels'=> [
                                'enabled'=>true,
                                'format'=>'{point.percentage:.1f} %',
                            ]
                        ]
                    ],
                    'series'=>
                        [
                            [
                                'name'=>'Brands',
                                'colorByPoint'=> true,
                                'data'=>$data
                            ]]
                ]]);
//            Yii::$app->cache->set($cacheKey, $content, 60 * 60 * 24);
        }
        return $content;
    }
}
