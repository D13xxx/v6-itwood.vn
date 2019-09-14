<?php
/* @var $this yii\web\View */
//use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

$this->title=Yii::t('backend','Danh sách rừng đã được duyệt');
?>
<?php \yii\widgets\Pjax::begin(); ?>
<?php $form=\yii\widgets\ActiveForm::begin()?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title">Bộ lọc thông tin lô rừng đã được duyệt</h4>
    </div>
    <div class="panel-body">
        <div class="col-sm-6">
            <?php
            $loaiQuyenSDD= \common\models\SysQuyenSuDungDat::find()->where(['trang_thai_id'=>\common\models\SysQuyenSuDungDat::TT_ACTIVE])->all();
            $listLoaiQuyenSDD= \yii\helpers\ArrayHelper::map($loaiQuyenSDD,'id','ten');
            ?>
            <?= $form->field($searchModel,'loai_quyen_sdd_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>$listLoaiQuyenSDD,
                'options'=>['prompt'=>Yii::t('backend','Loại quyền sử dụng đất')],
                'pluginOptions'=>['allowClear'=>true],
            ])->label(Yii::t('backend','Loại quyền sử dụng đất'))?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($searchModel,'so_hieu_van_ban')->textInput()->label(Yii::t('backend','Số hiệu văn bản'))?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($searchModel,'nam_cap_qsd_dat')->textInput()->label(Yii::t('backend','Năm cấp quyền sử dụng đất'))?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($searchModel,'to_ban_do_so')->textInput()?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($searchModel,'so_thua_dat')->textInput()?>
        </div>

        <div class="col-sm-6">
            <?php
            $loaiRung = \common\models\SysLoaiRung::find()->where(['trang_thai_id'=>\common\models\SysLoaiRung::TT_ACTIVE])->all();
            $listLoaiRung = \yii\helpers\ArrayHelper::map($loaiRung,'id','ten');
            ?>
            <?= $form->field($searchModel,'loai_rung_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>$listLoaiRung,
                'options'=>['prompt'=>Yii::t('backend','Loại rừng')],
                'pluginOptions'=>['allowClear'=>true],
            ])?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($searchModel,'dien_tich')->textInput()?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($searchModel,'tieu_khu')->textInput()?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($searchModel,'khoanh')->textInput()?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($searchModel,'lo')->textInput()?>
        </div>

        <div class="col-sm-12">
            <?= $form->field($searchModel,'dia_chi')->textInput()?>
        </div>

        <?php
        $userModel = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        $tinhThanhID = $userModel->sys_tinh_thanh_id;
        $quanHuyenID = $userModel->sys_quan_huyen_id;
        $xaPhuongID = $userModel->sys_xa_phuong_id;
        $quyenHan = Yii::$app->session->get('quyenHan');
        if($quyenHan=='UBNDHUYEN'||$quyenHan=='HATKIEMLAM'){
            $modelXaPhuong = \common\models\XaPhuong::find()->where(['and',['tinh_thanh_id'=>$tinhThanhID],['quan_huyen_id'=>$quanHuyenID],['trang_thai'=>\common\models\XaPhuong::TT_ACTIVE]])->all();
            $listXaPhuong = \yii\helpers\ArrayHelper::map($modelXaPhuong,'id','ten');

            echo $form->field($searchModel,'xa_phuong_id')->widget(\kartik\select2\Select2::className(),[
                    'data'=>$listXaPhuong,
                'options'=>['prompt'=>'Chọn xã phường'],
                'pluginOptions'=>['allowClear'=>true]
            ]);
        } else if($quyenHan=='CHICUCKIEMLAM'){
            $quanHuyen=\common\models\QuanHuyen::find()->where(['tinh_thanh_id'=>$tinhThanhID])->all();
            $listQuanHuyen=\yii\helpers\ArrayHelper::map($quanHuyen,'id','ten');
            echo '<div class="col-sm-6">';
            echo $form->field($searchModel, 'quan_huyen_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>$listQuanHuyen,
                'options'=>[
                    'prompt'=>'Lựa chọn quận huyện',
                    'onchange'=>'
                        $.get( "'.\yii\helpers\Url::toRoute('/dia-danh-hanh-chinh/xa-phuong/danh-sach-xa-phuong').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($searchModel, 'xa_phuong_id').'" ).html( data );
                            }
                        );
                    '
                ],
                'pluginOptions'=>['allowClear'=>true]
            ])->label('Quận huyện');
            echo '</div>';
            echo '<div class="col-sm-6">';
            if(is_null($searchModel->xa_phuong_id))
            {
                $listXaPhuong=array();
            }else {
                $xaPhuong=\common\models\XaPhuong::find()->where(['quan_huyen_id'=>$searchModel->quan_huyen_id])->all();
                $listXaPhuong=\yii\helpers\ArrayHelper::map($xaPhuong,'id','ten');
            }

            echo $form->field($searchModel, 'xa_phuong_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>$listXaPhuong,
                'options'=>[
                    'prompt'=>'Lựa chọn xã phường',
                ],
                'pluginOptions'=>['allowClear'=>true]
            ])->label('Xã phường');
            echo '</div>';
        } else if ($quyenHan=='Admin' || $quyenHan=='SupperAdmin'||$quyenHan=='TONGCUCKIEMLAM'){
            $tinhThanh=\common\models\TinhThanh::find()->all();
            $listTinhThanh=\yii\helpers\ArrayHelper::map($tinhThanh,'id','ten');
            echo '<div class="col-sm-4">';
            echo $form->field($searchModel,'tinh_thanh_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>$listTinhThanh,
                'options'=>[
                    'prompt'=>'Lựa chọn tỉnh thành',
                    'onchange'=>'
                        $.get( "'.\yii\helpers\Url::toRoute('/dia-danh-hanh-chinh/quan-huyen/danh-sach-quan-huyen').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($searchModel, 'quan_huyen_id').'" ).html( data );
                            }
                        );
                    '
                ],
                'pluginOptions'=>['allowClear'=>true]
            ])->label('Tỉnh thành');
            echo '</div>';
            if(is_null($searchModel->tinh_thanh_id))
            {
                $listQuanHuyen=array();
            }else {
                $quanHuyen=\common\models\QuanHuyen::find()->where(['tinh_thanh_id'=>$searchModel->tinh_thanh_id])->all();
                $listQuanHuyen=\yii\helpers\ArrayHelper::map($quanHuyen,'id','ten');
            }
            echo '<div class="col-sm-4">';
            echo $form->field($searchModel, 'quan_huyen_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>$listQuanHuyen,
                'options'=>[
                    'prompt'=>'Lựa chọn quận huyện',
                    'onchange'=>'
                        $.get( "'.\yii\helpers\Url::toRoute('/dia-danh-hanh-chinh/xa-phuong/danh-sach-xa-phuong').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($searchModel, 'xa_phuong_id').'" ).html( data );
                            }
                        );
                    '
                ],
                'pluginOptions'=>['allowClear'=>true]
            ])->label('Quận huyện');
            echo '</div>';
            if(is_null($searchModel->xa_phuong_id))
            {
                $listXaPhuong=array();
            }else {
                $xaPhuong=\common\models\XaPhuong::find()->where(['quan_huyen_id'=>$searchModel->quan_huyen_id])->all();
                $listXaPhuong=\yii\helpers\ArrayHelper::map($xaPhuong,'id','ten');
            }
            echo '<div class="col-sm-4">';
            echo $form->field($searchModel, 'xa_phuong_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>$listXaPhuong,
                'options'=>[
                    'prompt'=>'Lựa chọn xã phường',
                ],
                'pluginOptions'=>['allowClear'=>true]
            ])->label('Xã phường');
            echo '</div>';
        }
        ?>
    </div>

    <div class="panel-footer">
        <?= \yii\helpers\Html::submitButton(Yii::t('backend','Tìm kiếm'),[
            'class'=>'btn btn-primary',
            'data-method'=>'get',
        ])?>
    </div>
</div>
<?php \yii\widgets\ActiveForm::end()?>
<?php \yii\widgets\Pjax::end(); ?>

<div class="panel panel-success">
    <div class="panel-heading">
        <h4 class="panel-title">
            <?= Html::encode($this->title) ?>
        </h4>
    </div>
    <?php Pjax::begin(); ?>
    <div class="panel-body" >

        <?php
        $gridcolumn=[
            [
                'class'=>'yii\grid\SerialColumn',
            ],
            [
                'attribute'=>'ma',
                'value'=>function($data){
                    if($data->khong_co_dinh_danh==1){
                        return '';
                    } else {
                        return $data->ma;
                    }
                },
            ],
            [
                'attribute'=>'tieu_khu',
                'value'=>function($data){
                    return $data->khong_co_dinh_danh==1 ? '' : $data->tieu_khu;
                },
            ],
            [
                'attribute'=>'khoanh',
                'value'=>function($data){
                    return $data->khong_co_dinh_danh==1 ? '' : $data->khoanh;
                },
            ],
            [
                'attribute'=>'lo',
                'value'=>function($data){
                    return $data->khong_co_dinh_danh==1 ? '' : $data->lo;
                },
            ],
            [
                'attribute'=>'dien_tich',
            ],
            [
                'attribute'=>'so_thua_dat',
            ],
            [
                'attribute'=>'dia_chi',
            ],
            [
                'attribute'=>'chu_the_id',
                'value'=>function($data){
                    if($data->loai_hinh_chu_the==2){
                        $countHGD = \common\models\RegChuTheHoGiaDinh::find()->where(['id'=>$data->chu_the_id]);
                        if($countHGD->count()>0){
                            $modelHGD = $countHGD->one();
                            return $modelHGD->ten;
                        } else {
                            return '';
                        }
                    } else {
                        $countTC = \common\models\RegChuTheToChuc::find()->where(['id'=>$data->chu_the_id]);
                        if($countTC->count()>0){
                            $modelTC = $countTC->one();
                            return $modelTC->ten_to_chuc;
                        } else {
                            return '';
                        }
                    }
                },
                'hidden'=>true,
            ],
            [
                'attribute'=>'quyen_sdd_id',
                'label'=>'Loại quyền sử dụng đất',
                'value'=>function($data){
                    $modelQuyenSDD= \common\models\RegQuyenSuDungDat::find()->where(['id'=>$data->quyen_sdd_id]);
                    if($modelQuyenSDD->count()>0){
                        $modelQSD=$modelQuyenSDD->one();
                        $loaiQuyenSDD= \common\models\SysQuyenSuDungDat::find()->where(['id'=>$modelQSD->quyen_su_dung_dat_id])->one();
                        return $loaiQuyenSDD->ten;
                    } else {
                        return '';
                    }
                },
                'hidden'=>true,
            ],
            [
                'class'=>'yii\grid\ActionColumn',
                'template'=>'{view}',
            ],
        ];
        echo GridView::widget([
            'dataProvider'=>$dataProvider,
            'filterModel'=>$searchModel,
            'rowOptions' =>function($data){
                return ((int)\common\models\RegLoRung::CountLoRungPhucTra($data->id) >0) ? ['style'=>'background-color:#8bd83b; color: white'] : ['style'=>''];
            },
            'columns'=>$gridcolumn
        ])?>

    </div>
    <div class="panel-footer">
        <?php
        $exportConfig = [
            ExportMenu::FORMAT_HTML => false,
            ExportMenu::FORMAT_CSV => false,
            ExportMenu::FORMAT_TEXT =>false,
            ExportMenu::FORMAT_PDF =>false,
            ExportMenu::FORMAT_EXCEL_X =>false,
            ExportMenu::FORMAT_EXCEL => [
                'label' => Yii::t('backend', 'Xuất ra excel'),
//                'icon' => $isFa ? 'file-excel-o' : 'floppy-remove',
                'iconOptions' => ['class' => 'text-success'],
                'linkOptions' => [],
                'options' => ['title' => Yii::t('backend', 'Xuất dữ liệu ra file excel'),'class'=>'btn btn-default'],
                'alertMsg' => Yii::t('kvexport', 'Kết xuất kết quả ra excel'),
                'mime' => 'application/vnd.ms-excel',
                'extension' => 'xls',
                'writer' => ExportMenu::FORMAT_EXCEL
            ],
        ];
        echo ExportMenu::widget([
            'dataProvider'=>$dataProvider,
            'columns'=>$gridcolumn,
            'asDropdown' => false,
            'filename'=>'lo-rung-da-duyet',
            'exportConfig' => $exportConfig,
        ]);?>
    </div>
    <?php Pjax::end(); ?>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
