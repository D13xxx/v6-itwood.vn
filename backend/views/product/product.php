<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/19/2018
 * Time: 3:48 PM
 */

use backend\models\searchs\ProductsSearch;
use yii\grid\GridView;
use yii\helpers\Html;


$idPhongBan = $node->id;

$search = New ProductsSearch();
$dataProvider = $search->search(Yii::$app->request->queryParams);
$dataProvider->query->andFilterWhere(['product_id'=>$idPhongBan]);

?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">Danh mục sản phẩm</h4>
    </div>
    <div class="panel-body">
    <?= GridView::widget([
        'dataProvider'=>$dataProvider,
        'summary'=>'',
        'columns'=>[
            ['class'=>'yii\grid\SerialColumn'],
            'name',
            'price'
        ]
    ])?>
    </div>
    <div class="panel-footer">

    </div>
</div>
