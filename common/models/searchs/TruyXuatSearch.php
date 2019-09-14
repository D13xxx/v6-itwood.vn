<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/1/2019
 * Time: 8:46 AM
 */

namespace common\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TruyXuat;

class TruyXuatSearch extends TruyXuat
{

    public $ma='';

    public function rules()
    {
        return [
            [['ma'],'trim'],
            [['ma'], 'required'],
            [['ma',], 'string', 'max' => 255],
            [['ma'], 'string', 'min' => 6],
//            [['ma'],'safe']
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params){

        $dataProvider = array();

        if($this->load($params) && $this->validate()){
            $query = "(SELECT id, ma, tieu_khu as ten, khoanh as a, lo as b,trang_thai_id as c, '3' as bangKetQua FROM reg_lo_rung WHERE ma LIKE :ma_timkiem AND trang_thai_id !=0)
            UNION (SELECT id, ma, dien_tich_khai_thac as ten, ngay_bat_dau as a, ngay_ket_thuc as b, trang_thai_id as c, '4' as bangKetQua FROM reg_ho_so_xin_khai_thac WHERE ma LIKE :ma_timkiem AND trang_thai_id != 0)
            UNION (SELECT id, ma, ngay_lap as ten, reg_chu_the_id as b, ngay_duyet as c, trang_thai_id as c, '5' as bangKetQua FROM reg_ho_so_go WHERE ma LIKE :ma_timkiem AND trang_thai_id > 0)
            ";
            $dataProvider = Yii::$app->getDb()->createCommand($query,[':ma_timkiem'=>$this->ma.'%'])->queryAll();
        }

        return $dataProvider;
    }

}