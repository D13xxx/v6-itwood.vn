<?php

namespace common\widgets;

use common\models\RegChuTheHoGiaDinh;
use common\models\RegLoRung;
use Yii;
use yii\base\Widget;

/**
 * Class DbRegChuThe
 * Return a text block content stored in db
 * @package common\widgets\RegChuThe
 */
class DbHighChartsHoGiaDinh extends Widget
{
    public function run()
    {
//        $a= date('d/m/Y');
        $reChuTheCounts = RegChuTheHoGiaDinh::find()
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
            foreach($reChuTheCounts as $item1){
                $data[] = [
                    'name'=>RegChuTheHoGiaDinh::TRANG_THAI_ARRAY[$item1['trang_thai_id']].$item1['cnt'].'/'.$toTal,
                    'y'=>round($calCulate[$item1['trang_thai_id']]/$toTal*100,2),
                    'sliced'=>true,
                ];
            }
        }


//        $countHoGiaDinh= RegChuThe::find()->where(['loai_chu_the_id'=>1])->count();
//        $countHoGiaDinhDaCapQR = RegChuThe::find()->where(['loai_chu_the_id'=>1])->andWhere(['trang_thai_id'=>4])->count();
//        $countHoGiaDinhMoi = RegChuThe::find()->where(['loai_chu_the_id'=>1])->andWhere(['trang_thai_id'=>1])->count();
//        $countHoGiaDinhDeNghiDuyet = RegChuThe::find()->where(['loai_chu_the_id'=>1])->andWhere(['trang_thai_id'=>2])->count();
//        $countHoGiaDinhBiTraLai = RegChuThe::find()->where(['loai_chu_the_id'=>1])->andWhere(['trang_thai_id'=>3])->count();


//        $tiLeDaCapQR = $countHoGiaDinhDaCapQR/$countHoGiaDinh*100;
//        $tiLeMoi = $countHoGiaDinhMoi/$countHoGiaDinh*100;
//        $tiLeDeNghiDuyet = $countHoGiaDinhDeNghiDuyet/$countHoGiaDinh*100;
//        $tiLeBiTraLai = $countHoGiaDinhBiTraLai/$countHoGiaDinh*100;
//        $cacheKey = [
//            RegLoRung::class,
//        ];
//        $content = Yii::$app->cache->get($cacheKey);
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
