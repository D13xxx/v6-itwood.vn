<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/19/2018
 * Time: 9:45 AM
 */
use kartik\tree\TreeView;
use kartik\tree\Module;

echo TreeView::widget([
    'query' => \backend\models\Catalogs::find()->addOrderBy('root, lft'),
    'headingOptions' => ['label' => 'Danh mục'],
    'rootOptions' => ['label'=>'<span class="text-primary">Phòng ban</span>'],
    'topRootAsHeading' => false, // this will override the headingOptions
    'fontAwesome' => true,
    'displayValue'=>true,
    'showIDAttribute'=>false,
    'showNameAttribute'=>true,
    'isAdmin' => false,
    'showFormButtons'=>false,
    'iconEditSettings' => ['show' => 'none'],
    'softDelete' => true,
    'cacheSettings' => ['enableCache' => true],
    'footerOptions'=>['style'=>'display:none'], // Ẩn phần button của tree view
    'showInactive'=>true,
    'nodeAddlViews' => [
        Module::VIEW_PART_1 => '@backend/views/product/_form',
        Module::VIEW_PART_2 => '@backend/views/product/product',
        Module::VIEW_PART_3 => '',
        Module::VIEW_PART_4 => '',
        Module::VIEW_PART_5 => '',
    ],
]);