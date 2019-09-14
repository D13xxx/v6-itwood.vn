<?php
/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title=Yii::t('backend','Danh sách rừng cần phúc tra');
?>

<div class="panel panel-danger">
    <div class="panel-heading">
        <h4 class="panel-title">
            <?= Html::encode($this->title) ?>
        </h4>
    </div>
    <div class="panel-body">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider'=>$dataProvider,
            'filterModel'=>$searchModel,
            'columns'=>[
                ['class'=>'yii\grid\SerialColumn'],
                'ma',
                'tieu_khu',
                'khoanh',
                'lo',
                'dien_tich',
                'so_thua_dat',
                'dia_chi',
                [
                    'class'=>'yii\grid\ActionColumn',
                    'template'=>'{view}',
                ],
            ]
        ])?>
        <?php Pjax::end(); ?>
    </div>
</div>
<div class="clearfix"></div>
