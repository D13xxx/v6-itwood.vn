<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\RegQuyenSuDungDatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Giấy chứng nhận sử dụng đất');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-quyen-su-dung-dat-index">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?= Html::encode($this->title) ?>
            </h4>
        </div>
        <div class="panel-body">
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'ma',
                    [
                        'attribute'=>'quyen_su_dung_dat_id',
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\SysQuyenSuDungDat::find()->active()->all(),'id','ten'),
                        'value'=>function($data){
                            return $data->loaiQuyenSuDungDat ? $data->loaiQuyenSuDungDat->ten : '' ;
                        }
                    ],
                    'so_van_ban',
                    [
                        'attribute'=>'ngay_ban_hanh',
                        'value'=>function($data){
                            return ($data->ngay_ban_hanh=='' || $data->ngay_ban_hanh == null) ? '' : date("d/m/Y",strtotime($data->ngay_ban_hanh));
                        }
                    ],
                    'so_vao_so',
                    'co_quan_ban_hanh',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{them-lo-rung}',
                        'buttons'=>[
                            'them-lo-rung'=>function($url,$data){
                                $url= \yii\helpers\Url::to(['/quyen-su-dung-dat-va-rung/quyen-su-dung-dat-va-rung/them-lo-rung-moi','id'=>$data->id]);
                                return Html::a('<span class="glyphicon glyphicon-tree-conifer"></span>',$url,[
                                    'title'=>Yii::t('frontend','Thêm lô rừng')
                                ]);
                            }
                        ]
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} {update}',
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="panel-footer">
            <?= Html::a(Yii::t('backend', 'Thêm mới quyền sử dụng đất'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

</div>
