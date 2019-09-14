<?php
/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;

$this->title= Yii::t('backend','Danh mục lô rừng cần xét duyệt');
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <?= Html::encode($this->title) ?>
        </h4>
    </div>
    <div class="panel-body">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
           'dataProvider'=>$dataLoRung,
           'columns'=>[
               ['class'=>'yii\grid\SerialColumn'],
               [
                   'attribute'=>'ma',
                   'value'=>function($data){
                       if($data->khong_co_dinh_danh==1){
                           return '';
                       } else {
                           return $data->ma;
                       }
                   }
               ],
               [
                   'attribute'=>'tieu_khu',
                   'value'=>function($data){
                       return $data->khong_co_dinh_danh==1 ? '' : $data->tieu_khu;
                   }
               ],
               [
                   'attribute'=>'khoanh',
                   'value'=>function($data){
                       return $data->khong_co_dinh_danh==1 ? '' : $data->khoanh;
                   }
               ],
               [
                   'attribute'=>'lo',
                   'value'=>function($data){
                       return $data->khong_co_dinh_danh==1 ? '' : $data->lo;
                   }
               ],
               'dien_tich',
               'so_thua_dat',
               'dia_chi',
               [
                   'class'=>'yii\grid\ActionColumn',
                   'template'=>'{view}',
                   'buttons'=>[
                       'view'=>function($url,$data){
                            $url = Url::to(['/quan-ly-lo-rung/de-nghi-duyet/view','id'=>$data->id]);
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',$url,['title'=>Yii::t('backend','Xét duyệt lô rừng')]);
                       }
                   ]
               ],
           ]
        ])?>
        <?php Pjax::end(); ?>
    </div>
</div>
<div class="clearfix"></div>