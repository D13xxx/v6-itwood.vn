<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/19/2019
 * Time: 11:40 AM
 */
?>

<div id="content">
    <div class="cover"><img src="/themes/itwood/images/cover.png" width="1920" height="252" alt=""/></div>

    <div class="tintuc">
        <div class="maincontent">
            <h2><span>Tin tức từ iTwood<span></span></span></h2>
            <div class="noibat">
                <?php
                foreach ($modelTinHot as $tinHot){ ?>
                    <div class="tinhot">
                        <a href="javascript:;" class="imgBox"><img src="/themes/itwood/images/news_img.png" width="770" height="360" alt=""/></a>
                        <h3>
                            <?= \yii\helpers\Html::a($tinHot->tom_tat,['/site/chi-tiet-tin','id'=>$tinHot->id])?>
                        </h3>
                        <ul>
                            <li><span><?= date("d.m.Y",$tinHot->created_at)?></span></li>
                            <li><i class="icon"></i></li>
                            <li>
                                <?= \yii\helpers\Html::a('chi tiết<i class="icon"></i>',['/site/chi-tiet-tin','id'=>$tinHot->id])?>
                            </li>
                        </ul>
                    </div><!--end tinhot-->
                <?php }
                ?>


                <div class="tinnoibat">
                    <h3><a href="javascript:;">Tin tức nổi bật<span></span></a></h3>
                    <div class="danhsachtin">
                        <?php
                        $i=1;
                        foreach ($modelTinNoiBat as $key => $tinNoiBat){ ?>
                            <div class="tin1">
                                <p class="stt"><?= $i?></p>
                                <div class="noidung">
                                    <h4>
                                        <?= \yii\helpers\Html::a($tinNoiBat->tom_tat,['/site/chi-tiet-tin','id'=>$tinNoiBat->id])?>
                                    </h4>
                                    <ul>
                                        <li><span><?= date("d.m.Y",$tinNoiBat->created_at)?></span></li>
                                        <li><i class="icon"></i></li>
                                        <li>
                                            <?= \yii\helpers\Html::a('chi tiết<i class="icon"></i>',['/site/chi-tiet-tin','id'=>$tinNoiBat->id])?>
                                        </li>
                                    </ul>
                                </div><!--end noidung-->
                                <div style="clear:both;"></div>
                            </div><!--end tin1-->
                        <?php
                        $i++;
                        }
                        ?>

                    </div><!--end danhsachtin-->
                </div><!--end tinnoibat-->
                <div style="clear:both;"></div>
            </div><!--end noibat-->

            <div class="tinmoi">
                <h3><a href="javascript:;">Tin tức mới nhất</a></h3>
                <div class="danhsachtin">
                    <div class="tin1">
                        <a href="javascript:;" class="imgBox"><img src="/themes/itwood/images/news_img.png" width="770" height="360" alt=""/></a>
                        <div class="noidung">
                            <h4><a href="javascript:;">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id elit fermentum, lobortis tellus vel, convallis risus. Quisque</p>
                            <ul>
                                <li><span>10.04.2019</span></li>
                                <li><i class="icon"></i></li>
                                <li><a href="javascript:;">chi tiết<i class="icon"></i></a></li>
                            </ul>
                        </div><!--end noidung-->
                        <div style="clear:both;"></div>
                    </div><!--end tin1-->
                    <div class="tin1">
                        <a href="javascript:;" class="imgBox"><img src="/themes/itwood/images/news_img.png" width="770" height="360" alt=""/></a>
                        <div class="noidung">
                            <h4><a href="javascript:;">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id elit fermentum, lobortis tellus vel, convallis risus. Quisque</p>
                            <ul>
                                <li><span>10.04.2019</span></li>
                                <li><i class="icon"></i></li>
                                <li><a href="javascript:;">chi tiết<i class="icon"></i></a></li>
                            </ul>
                        </div><!--end noidung-->
                        <div style="clear:both;"></div>
                    </div><!--end tin1-->
                    <div class="tin1">
                        <a href="javascript:;" class="imgBox"><img src="/themes/itwood/images/news_img.png" width="770" height="360" alt=""/></a>
                        <div class="noidung">
                            <h4><a href="javascript:;">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id elit fermentum, lobortis tellus vel, convallis risus. Quisque</p>
                            <ul>
                                <li><span>10.04.2019</span></li>
                                <li><i class="icon"></i></li>
                                <li><a href="javascript:;">chi tiết<i class="icon"></i></a></li>
                            </ul>
                        </div><!--end noidung-->
                        <div style="clear:both;"></div>
                    </div><!--end tin1-->
                    <div class="tin1">
                        <a href="javascript:;" class="imgBox"><img src="/themes/itwood/images/news_img.png" width="770" height="360" alt=""/></a>
                        <div class="noidung">
                            <h4><a href="javascript:;">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id elit fermentum, lobortis tellus vel, convallis risus. Quisque</p>
                            <ul>
                                <li><span>10.04.2019</span></li>
                                <li><i class="icon"></i></li>
                                <li><a href="javascript:;">chi tiết<i class="icon"></i></a></li>
                            </ul>
                        </div><!--end noidung-->
                        <div style="clear:both;"></div>
                    </div><!--end tin1-->
                    <div class="tin1">
                        <a href="javascript:;" class="imgBox"><img src="/themes/itwood/images/news_img.png" width="770" height="360" alt=""/></a>
                        <div class="noidung">
                            <h4><a href="javascript:;">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id elit fermentum, lobortis tellus vel, convallis risus. Quisque</p>
                            <ul>
                                <li><span>10.04.2019</span></li>
                                <li><i class="icon"></i></li>
                                <li><a href="javascript:;">chi tiết<i class="icon"></i></a></li>
                            </ul>
                        </div><!--end noidung-->
                        <div style="clear:both;"></div>
                    </div><!--end tin1-->
                </div><!--end danh sachtin-->
                <a href="javascript:;" class="btnXemthem">Xem thêm</a>
            </div><!--end tinmoi-->

            <div class="tinxemnhieu">
                <h3><a href="javascript:;">Tin được xem nhiều<span></span></a></h3>
                <div class="danhsachtin">
                    <div class="tin1">
                        <a href="javascript:;" class="imgBox"><img src="/themes/itwood/images/news_img.png" width="770" height="360" alt=""/></a>
                        <div class="noidung">
                            <h4><a href="javascript:;">Lorem ipsum dolor sit amet, nsectetur adipiscing elit.</a></h4>
                            <ul><li><a href="javascript:;">chi tiết<i class="icon"></i></a></li></ul>
                        </div><!--end noidung-->
                        <div style="clear:both;"></div>
                    </div><!--end tin1-->
                    <div class="tin1">
                        <a href="javascript:;" class="imgBox"><img src="/themes/itwood/images/news_img.png" width="770" height="360" alt=""/></a>
                        <div class="noidung">
                            <h4><a href="javascript:;">Lorem ipsum dolor sit amet, nsectetur adipiscing elit.</a></h4>
                            <ul><li><a href="javascript:;">chi tiết<i class="icon"></i></a></li></ul>
                        </div><!--end noidung-->
                        <div style="clear:both;"></div>
                    </div><!--end tin1-->
                    <div class="tin1">
                        <a href="javascript:;" class="imgBox"><img src="/themes/itwood/images/news_img.png" width="770" height="360" alt=""/></a>
                        <div class="noidung">
                            <h4><a href="javascript:;">Lorem ipsum dolor sit amet, nsectetur adipiscing elit.</a></h4>
                            <ul><li><a href="javascript:;">chi tiết<i class="icon"></i></a></li></ul>
                        </div><!--end noidung-->
                        <div style="clear:both;"></div>
                    </div><!--end tin1-->
                    <div class="tin1">
                        <a href="javascript:;" class="imgBox"><img src="/themes/itwood/images/news_img.png" width="770" height="360" alt=""/></a>
                        <div class="noidung">
                            <h4><a href="javascript:;">Lorem ipsum dolor sit amet, nsectetur adipiscing elit.</a></h4>
                            <ul><li><a href="javascript:;">chi tiết<i class="icon"></i></a></li></ul>
                        </div><!--end noidung-->
                        <div style="clear:both;"></div>
                    </div><!--end tin1-->
                </div><!--end danh sachtin-->
            </div><!--end tinxemnhieu-->
            <div style="clear:both;"></div>
        </div><!--end maincontent-->
    </div><!--end tintuc-->

    <div class="doitac duantieubieu">
        <div class="maincontent">
            <h2><span></span>Các dự án tiêu biểu</h2>
            <marquee><ul>
                    <li><img src="/themes/itwood/images/logo_1.png" width="111" height="114" alt=""/><span>FAO</span></li>
                    <li><img src="/themes/itwood/images/logo2.png" width="111" height="114" alt=""/><span>HAWA</span></li>
                    <li><img src="/themes/itwood/images/logo_1.png" width="111" height="114" alt=""/><span>FAO</span></li>
                    <li><img src="/themes/itwood/images/logo2.png" width="111" height="114" alt=""/><span>HAWA</span></li>
                    <li><img src="/themes/itwood/images/logo_1.png" width="111" height="114" alt=""/><span>FAO</span></li>
                </ul></marquee>
        </div><!--end maincontent-->
    </div><!--end duantieubieu-->
</div><!--end content-->

