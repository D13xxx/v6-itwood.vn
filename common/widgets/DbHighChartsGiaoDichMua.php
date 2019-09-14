<?php

namespace common\widgets;

use backend\modules\GiaoDich\models\BanRung;
use common\models\ChuSoHuu;
use common\models\RegChuThe;
use common\models\RegHoGiaDinh;
use common\models\RegLoRungTrong;
use Yii;
use yii\base\Widget;

/**
 * Class DbRegChuThe
 * Return a text block content stored in db
 * @package common\widgets\RegChuThe
 */
class DbHighChartsGiaoDichMua extends Widget
{
//    public $chuTheID =
    public function run()
    {
        $chuTheId = Yii::$app->session->get('reg_chu_the_id');
        if (!empty($chuTheId)) {
            $banRungSum = \backend\modules\GiaoDich\models\BanRung::find()
                ->select(['id','SUM(khoi_luong_go + khoi_luong_cui) as klg'])
                ->where('chu_so_huu_id ='.$chuTheId)
                ->groupBy(['id'])
                ->limit('10')
                ->asArray()
                ->all();

            $calCulate=array();
            $data = array();

            $toTal=array();
            foreach ($banRungSum as $items)
            {
                $calCulate[]=(int)$items['klg'];
            }
            $cacheKey = [
                BanRung::class,
            ];
            $content = Yii::$app->cache->get($cacheKey);
            if (!$content) {
                $content.=\dosamigos\highcharts\HighCharts::widget([
                    'clientOptions' => [
                        'chart' => [
                            'type' => 'spline',
                            'scrollablePlotArea'=>[
                                'minWidth'=>'600',
                                'scrollPositionX'=> '1',
                            ]
                        ],
                        'exporting' => [
                            'enabled' => false
                        ],
                        'credits' => [
                            'enabled' => false
                        ],
                        'title' => [
                            'text' => ' '
                        ],
                        'yAxis'=>[
                            'title'=> [
                                'text'=> ' Bản tỉ lệ 10 lần giao dịch gần nhất '
                            ],
                            'minorGridLineWidth'=> 0,
                            'gridLineWidth'=> 0,
                            'alternateGridColor'=> null,
                            'plotBands'=> [[ // Light air
                                'from'=> 0.3,
                                'to'=> 1.5,
                                'color'=> 'rgba(68, 170, 213, 0.1)',
                                'label'=> [
                                    'text'=> 'Light air',
                                    'style'=> [
                                        'color'=> '#606060'
                                    ]
                                ]
                            ],
                                [ // Light breeze
                                    'from'=> 1.5,
                                    'to'=> 3.3,
                                    'color'=> 'rgba(0, 0, 0, 0)',
                                    'label'=> [
                                        'text'=> 'Light breeze',
                                        'style'=> [
                                            'color'=> '#606060'
                                        ]
                                    ]
                                ],
                                [ // Gentle breeze
                                    'from'=> 3.3,
                                    'to'=> 5.5,
                                    'color'=> 'rgba(68, 170, 213, 0.1)',
                                    'label'=> [
                                        'text'=> 'Gentle breeze',
                                        'style'=> [
                                            'color'=> '#606060'
                                        ]
                                    ]
                                ],
                                [ // Moderate breeze
                                    'from'=> 5.5,
                                    'to'=> 8,
                                    'color'=> 'rgba(0, 0, 0, 0)',
                                    'label'=> [
                                        'text'=> 'Moderate breeze',
                                        'style'=> [
                                            'color'=> '#606060'
                                        ]
                                    ]
                                ],
                                [ // Fresh breeze
                                    'from'=> 8,
                                    'to'=> 11,
                                    'color'=> 'rgba(68, 170, 213, 0.1)',
                                    'label'=> [
                                        'text'=> 'Fresh breeze',
                                        'style'=> [
                                            'color'=> '#606060'
                                        ]
                                    ]
                                ],
                                [ // Strong breeze
                                    'from'=> 11,
                                    'to'=> 80,
                                    'color'=> 'rgba(0, 0, 0, 0)',
                                    'label'=> [
                                        'text'=> 'Strong breeze',
                                        'style'=> [
                                            'color'=> '#606060'
                                        ]
                                    ]
                                ],
                                [ // High wind
                                    'from'=> 80,
                                    'to'=> 100,
                                    'color'=> 'rgba(68, 170, 213, 0.1)',
                                    'label'=> [
                                        'text'=> 'High wind',
                                        'style'=> [
                                            'color'=> '#606060'
                                        ]
                                    ]
                                ]]
                        ],
                        'xAxis' => [
                            'type'=>'đatetime',
                            'labels' => [
                                'overflow' => 'justify'
                            ]
                        ],
                        'series'=> [
                            [
                                'name'=>'Tỉ lệ 10 lần giao dịch gần nhất',
                                'data'=>$calCulate
                            ]
                        ],
                        'navigation'=> [
                            'menuItemStyle'=> [
                                'fontSize'=> '10px'
                            ]
                        ]

                    ]]);
                Yii::$app->cache->set($cacheKey, $content, 60 * 60 * 24);
            }
            return $content;

        }
        else{
            echo '';
        }
    }
}
