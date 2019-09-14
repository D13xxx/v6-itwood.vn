<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/23/2019
 * Time: 3:23 PM
 */
use yii\helpers\Url;

$moRong = substr($fileName,-3);

if($moRong=='pdf'){
    echo \yii2assets\pdfjs\PdfJs::widget([
        'url'=>'/uploads/quyen-su-dung-dat/'.urlencode($fileName)
    ]);
//    Yii::$app->response->sendFile('/uploads/chu-the/to-chuc/'.$fileName,$fileName);
} else {
    echo \yii\helpers\Html::img('/uploads/quyen-su-dung-dat/'.$fileName,['style'=>'width: 600px;height:auto']);
}