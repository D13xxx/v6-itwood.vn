<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/19/2018
 * Time: 9:45 AM
 */
use kartik\tree\TreeView;
use backend\models\PhongBan;

echo TreeView::widget([
    'query'=>PhongBan::find()->addOrderBy('phong_ban_cha_id,level'),
    'headingOptions' => ['label' => 'Phòng ban'],
    'fontAwesome' => false,
    'displayValue' => 1,
    'softDelete' => false,
    'cacheSettings' => [
        'enableCache' => true   // defaults to true
    ]
]);