<?php

namespace common\widgets;

use Yii;
use yii\base\Widget;
use common\models\RegChuThe;
use common\models\RegHoSoGo;
use common\models\RegLoRungTrong;
use common\models\RegHoSoKhaiThacBkls;

/**
 * Class DbRegChuThe
 * Return a text block content stored in db
 * @package common\widgets\RegChuThe
 */
class SessionView extends Widget
{
    /**
     * @var string text block key
     */
//	public $title='Chủ thể';
//    public $loai_chu_the_id;//Hộ gia đình:1, Doanh nghiệp 0;
//	public $trang_thai_id;//Đăng ký, Đề nghị xác nhận, Đã duyệt;
	
//	public $totalRec=5;//Số lượng bản ghi;
    /**
     * @return string
     */
	public $maTimKiem ='';
	public $kiemTraKey = 0;
    public function run()
    {
        $session = Yii::$app->session;
		
		if($this->maTimKiem!=''||$this->maTimKiem!=null)
		{
			if($session['count']==null ||$session['count']==''){
				$session['count']=1;
				$session['data'] = $this->maTimKiem;
			} else {
				$dataSession = explode(';',$session['data']);
				foreach($dataSession as $giaTri)
				{
					if($giaTri== $this->maTimKiem){
						$this->kiemTraKey = 1;
						break;
					} else {
						$this->kiemTraKey = 0;
					}
				}
				if($this->kiemTraKey==0){
					if($session['count'] <= 20){
						$bodem = $session['count'];
						$session['count']=intval($bodem)+1;
						$session['data'] = $this->maTimKiem.';'.$session['data'];
						
					} else {
						$session['count']=20;
						$dataSession[0]= $this->maTimKiem;
						$i=1;
						foreach($dataSession as $value){
							if($i>=20){
								unset($dataSession[$i]);
							}
							$i++;
						}
						$session['data']=implode(';',$dataSession);
					}
				}
			}
		}
        $cacheKey = [
			$session,
        ];
        $content = Yii::$app->cache->get($cacheKey);
        if (!$content) {
            // $content='<div class="row">';
			//$content .= 'Ma kiem tra:'.$this->kiemTraKey.'<br>';
				$ketQua = explode(';',$session['data']);
				if(Yii::$app->controller->action->id=='index'){
					$content .= '<div class="panel panel-itwood">';
						$content .= '<div class="panel-heading">';
							$content .='<h4 class="panel-title">Kết quả truy xuất trước</h4>';
						$content .='</div>';
						$content .= '<div class="panel-body">';
							$content .='<table class="table-hover table-bordered table">';
								if($ketQua[0] == '' || $ketQua == null){
									
									$content .= '<tbody>';
									$content .= '<tr>';
									$content .= '</tr>';
									$content .= '</tbody>';
								} else {
								$content .= '<tbody>';
									foreach($ketQua as $rec){
										if(RegHoSoGo::find()->where(['ma'=>$rec])->count()>0){
											$modelHoSoGo = RegHoSoGo::find()->where(['ma'=>$rec])->one();
											$content .= '<tr>';
												$content .= '<td style="width:25%"><a href="/truy-xuat/view-ho-so-go?id='.$modelHoSoGo->id.'">'.$rec.'</a></td>';
												$content .= '<td style="width:25%">'.$modelHoSoGo->ten.'</td>';
												$content .= '<td style="width:25%">'.$modelHoSoGo->regChuThe->ten.'</td>';
												$content .= '<td style="width:25%">Hồ sơ gỗ</td>';
											$content .= '</tr>';
										}
										if(RegLoRungTrong::find()->where(['ma'=>$rec])->count()>0){
											$modelLoRungTrong = RegLoRungTrong::find()->where(['ma'=>$rec])->one();
											$content .= '<tr>';
												$content .= '<td style="width:25%"><a href="/truy-xuat/view-lo-rung-trong?id='.$modelLoRungTrong->id.'">'.$rec.'</a></td>';
												$content .= '<td style="width:25%">'.Yii::$app->lookup->item('loai_rung_id',$modelLoRungTrong->loai_rung_id).'</td>';
												$content .= '<td style="width:25%">'.$modelLoRungTrong->regChuThe->ten.'</td>';
												$content .= '<td style="width:25%">Lô rừng trồng</td>';
											$content .= '</tr>';
										}
										if(RegChuThe::find()->where(['ma'=>$rec])->count()>0){
											$modelChuThe = RegChuThe::find()->where(['ma'=>$rec])->one();
											$content .= '<tr>';
												$content .= '<td style="width:25%"><a href="/truy-xuat/view-chu-the?id='.$modelChuThe->id.'">'.$rec.'</a></td>';
												$content .= '<td style="width:25%">'.$modelChuThe->ten.'</td>';
												$content .= '<td style="width:25%">'.Yii::$app->lookup->item('loai_chu_the_id',$modelChuThe->loai_chu_the_id).'</td>';
												$content .= '<td style="width:25%">Hồ sơ chủ thể</td>';
											$content .= '</tr>';
										}
										if(RegHoSoKhaiThacBkls::find()->where(['ma'=>$rec])->count()>0){
											$modelHoSoKhaiThac = RegHoSoKhaiThacBkls::find()->where(['ma'=>$rec])->one();
											$content .= '<tr>';
												$content .= '<td style="width:25%"><a href="/truy-xuat/view-ho-so-khai-thac?id='.$modelHoSoKhaiThac->id.'">'.$rec.'</a></td>';
												$content .= '<td style="width:25%">'.$modelHoSoKhaiThac->qr_code.'</td>';
												$content .= '<td style="width:25%">'.$modelHoSoKhaiThac->regHoSoKhaiThac->ma.'</td>';
												$content .= '<td style="width:25%">Bảng kê lâm sản</td>';
											$content .= '</tr>';
										}
										if(RegHoSoGo::find()->where(['ma'=>$rec])->count()<=0 && RegLoRungTrong::find()->where(['ma'=>$rec])->count()<= 0 && RegChuThe::find()->where(['ma'=>$rec])->count()<=0 && RegHoSoKhaiThacBkls::find()->where(['ma'=>$rec])->count()<=0){
											$content .= '<tr>';
												$content .= '<td style="width:25%"><a href="/truy-xuat/index?TruyXuatSearch%5Bma%5D='.$rec.'">'.$rec.'</a></td>';
												$content .= '<td style="width:25%">Không tìm thấy hồ sơ </td>';

											$content .= '</tr>';
										}
									}
								$content .= '</tbody>';	
								}
							$content .= '</table>';
						$content .='</div>';
					//$content .= $session['data'];
					$content .='</div>';
				$content .='</div>';
				} else {
				$content .= '<div class="panel panel-itwood">';
						$content .= '<div class="panel-heading">';
							$content .='<h4 class="panel-title">Kết quả truy xuất trước</h4>';
						$content .='</div>';
						$content .= '<div class="panel-body">';
							$content .='<table class="table-hover table-bordered table">';
								if($ketQua[0] == '' || $ketQua == null){
									
									$content .= '<tbody>';
									$content .= '<tr>';
									$content .= '</tr>';
									$content .= '</tbody>';
								} else {
								$content .= '<tbody>';
									foreach($ketQua as $rec){
										if(RegHoSoGo::find()->where(['ma'=>$rec])->count()>0){
											$modelHoSoGo = RegHoSoGo::find()->where(['ma'=>$rec])->one();
											$content .= '<tr>';
												$content .= '<td style="width:25%"><a href="/truy-xuat/view-ho-so-go?id='.$modelHoSoGo->id.'">'.$rec.'</a></td>';
												$content .= '<td style="width:25%">'.$modelHoSoGo->ten.'</td>';
												$content .= '<td style="width:25%">'.$modelHoSoGo->regChuThe->ten.'</td>';
												$content .= '<td style="width:25%">Hồ sơ gỗ</td>';
											$content .= '</tr>';
										}
										if(RegLoRungTrong::find()->where(['ma'=>$rec])->count()>0){
											$modelLoRungTrong = RegLoRungTrong::find()->where(['ma'=>$rec])->one();
											$content .= '<tr>';
												$content .= '<td style="width:25%"><a href="/truy-xuat/view-lo-rung-trong?id='.$modelLoRungTrong->id.'">'.$rec.'</a></td>';
												$content .= '<td style="width:25%">'.Yii::$app->lookup->item('loai_rung_id',$modelLoRungTrong->loai_rung_id).'</td>';
												$content .= '<td style="width:25%">'.$modelLoRungTrong->regChuThe->ten.'</td>';
												$content .= '<td style="width:25%">Lô rừng trồng</td>';
											$content .= '</tr>';
										}
										if(RegChuThe::find()->where(['ma'=>$rec])->count()>0){
											$modelChuThe = RegChuThe::find()->where(['ma'=>$rec])->one();
											$content .= '<tr>';
												$content .= '<td style="width:25%"><a href="/truy-xuat/view-chu-the?id='.$modelChuThe->id.'">'.$rec.'</a></td>';
												$content .= '<td style="width:25%">'.$modelChuThe->ten.'</td>';
												$content .= '<td style="width:25%">'.Yii::$app->lookup->item('loai_chu_the_id',$modelChuThe->loai_chu_the_id).'</td>';
												$content .= '<td style="width:25%">Hồ sơ chủ thể</td>';
											$content .= '</tr>';
										}
										if(RegHoSoKhaiThacBkls::find()->where(['ma'=>$rec])->count()>0){
											$modelHoSoKhaiThac = RegHoSoKhaiThacBkls::find()->where(['ma'=>$rec])->one();
											$content .= '<tr>';
												$content .= '<td style="width:25%"><a href="/truy-xuat/view-ho-so-khai-thac?id='.$modelHoSoKhaiThac->id.'">'.$rec.'</a></td>';
												$content .= '<td style="width:25%">'.$modelHoSoKhaiThac->qr_code.'</td>';
												$content .= '<td style="width:25%">'.$modelHoSoKhaiThac->regHoSoKhaiThac->ma.'</td>';
												$content .= '<td style="width:25%">Bảng kê lâm sản</td>';
											$content .= '</tr>';
										}
										if(RegHoSoGo::find()->where(['ma'=>$rec])->count()<=0 && RegLoRungTrong::find()->where(['ma'=>$rec])->count()<= 0 && RegChuThe::find()->where(['ma'=>$rec])->count()<=0 && RegHoSoKhaiThacBkls::find()->where(['ma'=>$rec])->count()<=0){
											$content .= '<tr>';
												$content .= '<td style="width:25%"><a href="/truy-xuat/index?TruyXuatSearch%5Bma%5D='.$rec.'">'.$rec.'</a></td>';
												$content .= '<td style="width:25%">Không tìm thấy hồ sơ </td>';

											$content .= '</tr>';
										}
									}
								$content .= '</tbody>';	
								}
							$content .= '</table>';
						$content .='</div>';
					//$content .= $session['data'];
					$content .='</div>';	
				// $content .='</div>';
				}
            Yii::$app->cache->set($cacheKey, $content, 60 * 60 * 24);
        }
        return $content;
    }
}
