<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RegLoRung;

/**
 * RegLoRungSearch represents the model behind the search form of `common\models\RegLoRung`.
 */
class RegLoRungSearch extends RegLoRung
{
    /**
     * {@inheritdoc}
     */

    public $loai_quyen_sdd_id ='';
    public $so_hieu_van_ban='';
    public $nam_cap_qsd_dat='';

    public function rules()
    {
        return [
            [['id','khong_co_dinh_danh', 'tinh_thanh_id', 'quan_huyen_id', 'xa_phuong_id', 'loai_rung_id', 'trang_thai_id', 'nguoi_tao_id', 'nguoi_sua_id', 'nguoi_duyet_id', 'chu_the_id','loai_quyen_sdd_id'], 'integer'],
            [['so_hieu_van_ban','nam_cap_qsd_dat','quyen_sdd_id','tieu_khu', 'khoanh', 'lo', 'dia_chi', 'ma', 'ngay_tao', 'ngay_sua', 'ngay_duyet','dien_tich','so_thua_dat','to_ban_do_so'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RegLoRung::find();
        $query->leftJoin('reg_quyen_su_dung_dat','reg_quyen_su_dung_dat.id=quyen_sdd_id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        if($this->quan_huyen_id==0){
            $quanHuyenID = null;
        } else {
            $quanHuyenID=$this->quan_huyen_id;
        }

        if($this->tinh_thanh_id==0){
            $tinhThanhID = null;
        } else {
            $tinhThanhID=$this->tinh_thanh_id;
        }
        if($this->xa_phuong_id==0){
            $xaPhuongID = null;
        } else {
            $xaPhuongID=$this->xa_phuong_id;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'tinh_thanh_id' => $tinhThanhID,
            'quan_huyen_id' => $quanHuyenID,
            'xa_phuong_id' => $xaPhuongID,
            'loai_rung_id' => $this->loai_rung_id,
            'reg_lo_rung.trang_thai_id' => $this->trang_thai_id,
            'nguoi_tao_id' => $this->nguoi_tao_id,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_sua_id' => $this->nguoi_sua_id,
            'ngay_sua' => $this->ngay_sua,
            'nguoi_duyet_id' => $this->nguoi_duyet_id,
            'ngay_duyet' => $this->ngay_duyet,
//            'quyen_sdd_id' => $this->quyen_sdd_id,
            'chu_the_id' => $this->chu_the_id,
            'khong_co_dinh_danh' => $this->khong_co_dinh_danh,
        ]);

        $query->andFilterWhere(['like', 'tieu_khu', $this->tieu_khu])
            ->andFilterWhere(['like', 'khoanh', $this->khoanh])
            ->andFilterWhere(['like', 'lo', $this->lo])
            ->andFilterWhere(['like', 'dia_chi', $this->dia_chi])
            ->andFilterWhere(['like', 'reg_quyen_su_dung_dat.ma', $this->quyen_sdd_id])
            ->andFilterWhere(['like', 'dien_tich', $this->dien_tich])
            ->andFilterWhere(['like', 'so_thua_dat', $this->so_thua_dat])
            ->andFilterWhere(['like', 'to_ban_do_so', $this->to_ban_do_so])
            ->andFilterWhere(['like', 'reg_quyen_su_dung_dat.quyen_su_dung_dat_id', $this->loai_quyen_sdd_id])
            ->andFilterWhere(['like', 'reg_quyen_su_dung_dat.so_van_ban', $this->so_hieu_van_ban])
            ->andFilterWhere(['like', 'reg_quyen_su_dung_dat.ngay_ban_hanh', $this->nam_cap_qsd_dat])
            ->andFilterWhere(['like', 'reg_lo_rung.ma', $this->ma]);

        return $dataProvider;
    }


}
