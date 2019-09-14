<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\models\searchs\TruyXuatSearch;

$this->title =Yii::t('frontend','Kết quả tìm kiếm');
?>
<section class="single-page-title single-page-title-services">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><?= Yii::t('frontend','Truy xuất nguồn gốc')?></h2>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<section class="featured-box">
    <div>&nbsp;</div>
    <div class="container">
        <div class="row">
            <?php \yii\widgets\Pjax::begin(); ?>
            <?php $form=\yii\widgets\ActiveForm::begin()?>
            <div class="col-sm-10">
                <div class="form-group">
                    <label for="nameTwo" class="sr-only"><?= Yii::t('frontend','Nhập mã truy xuất')?></label>
					<?= $form->field($searchModel, 'ma')->textInput(['class' => 'form-control'])->textInput(['placeholder' => "Nhập mã truy xuất"])->label(false) ?>                   
                </div>
            </div>
            <div class="col-sm-2">
                <?= \yii\helpers\Html::submitButton(Yii::t('frontend','Truy xuất'),[
                    'class'=>'btn btn-primary btn-lg pull-right',
                    'data-method'=>'get',
                ])?>
            </div>
            <?php \yii\widgets\ActiveForm::end()?>
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
    </div>
</section>

<section class="itwood-search">
    <div class="container">`
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-itwood">
                <div class="panel-heading">
                    <h4 class="panel-title"><?= Yii::t('frontend','Kết quả tìm kiếm') ?></h4>
                </div>
                <div class="panel-body">    
                    <?php
                    if(count($data)>0){
                    foreach ($data as $item){?>
                        <span>
                          <?php if((int)$item['bangKetQua']==1){
                            echo ' <strong style="font-size:18px;">Mã truy xuất: '. Html::a($item['ma'], '/truy-xuat/view-ho-gia-dinh?id=' . $item['id']).'</strong>';  ?>
                        <?php }elseif((int)$item['bangKetQua']==2){
                            echo '<strong style="font-size:18px;">Mã truy xuất: '.Html::a($item['ma'], '/truy-xuat/view-to-chuc?id=' . $item['id']).'</strong>';  ?>
                        <?php }elseif ((int)$item['bangKetQua']==3){
                            echo '<strong style="font-size:18px;"> Mã truy xuất: '. Html::a($item['ma'], '/truy-xuat/view-lo-rung?id=' . $item['id']).'</strong>';
                        }elseif ((int)$item['bangKetQua']==4){
                            echo '<strong style="font-size:18px;"> Mã truy xuất: '. Html::a($item['ma'], '/truy-xuat/view-dang-ky-khai-thac?id=' . $item['id']).'</strong>';
                        }elseif ((int)$item['bangKetQua']==5){
                            echo '<strong style="font-size:18px;"> Mã truy xuất: '. Html::a($item['ma'], '/truy-xuat/view-ho-so-go?id=' . $item['id']).'</strong>';
                        }?>
                        </span><br> 
                         <span>
                            <?php if((int)$item['bangKetQua']==1){
                              echo "Loại hồ sơ: Hồ sơ chủ thể Hộ Gia Đình";?>
                            <?php }elseif((int)$item['bangKetQua']==2){
                                 echo "Loại hồ sơ: Hồ sơ chủ thể Tổ chức";?>
                            <?php }elseif ((int)$item['bangKetQua']==3){
                                 echo "Loại hồ sơ: Lô rừng trồng";
                            }elseif ((int)$item['bangKetQua']==4){
                                echo "Loại hồ sơ: Hồ sơ Đăng ký khai thác";
                            }elseif ((int)$item['bangKetQua']==5) {
                                echo 'Loại hồ sơ: Hồ sơ gỗ';
                            }?>
                        </span> <br>
                        <span>
                            <?php if((int)$item['bangKetQua']==1){
                               echo 'Tên chủ thể: '.$item['ten']; ?>
                            <?php }elseif((int)$item['bangKetQua']==2){
                                echo 'Tên tổ chức: '.$item['ten']; ?>
                            <?php }elseif ((int)$item['bangKetQua']==3){
                                echo 'Định danh rừng: '.$item['ma']; ?>
                             <?php }elseif ((int)$item['bangKetQua']==4){
                               echo 'Diện tích đăng ký khai thác: '.$item['ten'];
                            } elseif ((int)$item['bangKetQua']==5){
                                echo 'Ngày lập hồ sơ: '.$item['ten'];
                            }?>
                        </span><br>  
                        <span>
                            <?php if((int)$item['bangKetQua']==1){
                               echo 'Tên chủ thể: '. '<span>'.$item['ten'].'</span>';?>
                            <?php }elseif((int)$item['bangKetQua']==2){
                                 echo 'Tên tổ chức: '.$item['ten'].'</span>';?>
                            <?php }elseif ((int)$item['bangKetQua']==3){
                                 $modelLoRung = common\models\RegLoRung::find()->where(['id'=>$item['id']])->one();
                                 $modelLoaiRung = \common\models\SysLoaiRung::find()->where(['id'=>$modelLoRung->loai_rung_id])->one();
                               echo 'Loại rừng: '. '<span>'.$modelLoaiRung->ten.'</span>';?>
                            <?php }elseif ((int)$item['bangKetQua']==4){
                                $tongKhoiLuongDuKien = \common\models\RegHoSoXinKhaiThac::TongKhoiLuongDuKien($item['id']);
                                echo 'Tổng khối lượng dự kiến: '. '<span>'.$tongKhoiLuongDuKien.'</span>';
                            } elseif((int)$item['bangKetQua']==5){
                                $tongKhoiLuongGo = \common\models\RegHoSoGo::TongKhoiLuongLoGo($item['id']);
                                echo 'Tổng khối lượng gỗ: <span>'.$tongKhoiLuongGo.'</span>';
                            }?>
                        </span><br>
                        <span>
                            <?php if((int)$item['bangKetQua']==1){
                               echo 'Tình trạng chủ thể: '.\common\models\RegChuTheHoGiaDinh::TRANG_THAI_ARRAY[(int)$item['c']];?>
                            <?php }elseif((int)$item['bangKetQua']==2){
                                echo 'Tình trạng chủ thể: '.\common\models\RegChuTheToChuc::TRANG_THAI_ARRAY[(int)$item['c']];?>
                            <?php }elseif ((int)$item['bangKetQua']==3){
                                echo 'Tình trạng lô rừng: '.\common\models\RegLoRung::TT_ARRAY()[(int)$item['c']];
                            }elseif ((int)$item['bangKetQua']==4){
                                echo "Tình trạng hồ sơ đăng ký: ".\common\models\RegHoSoXinKhaiThac::TT_HOSO_ARRAY()[(int)$item['c']];
                            }elseif ((int)$item['bangKetQua']==5){
                                echo 'Tình trạng hồ sơ gỗ: '.\common\models\RegHoSoGo::TT_HSG_ARRAY()[(int)$item['c']];
                            }?>
                        </span> <br>
                       
                        <hr>
                    <?php }}?>
                </div>
            </div>
        </div>
        </div>
        <div class="row">

        <!-- </div> -->
    </div><!-- /.container -->
</section>
<!-- /.client-logo -->