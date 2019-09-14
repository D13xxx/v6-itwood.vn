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
        'url'=>'/uploads/chu-the/to-chuc/'.urlencode($fileName)
    ]);
//    Yii::$app->response->sendFile('/uploads/chu-the/to-chuc/'.$fileName,$fileName);
} else {
    echo \yii\helpers\Html::img('/uploads/chu-the/to-chuc/'.$fileName,['style'=>'width: 500px;height:auto']);
}