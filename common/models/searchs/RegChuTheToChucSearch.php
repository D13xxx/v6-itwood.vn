<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RegChuTheToChuc;

/**
 * RegChuTheToChucSearch represents the model behind the search form of `common\models\RegChuTheToChuc`.
 */
class RegChuTheToChucSearch extends RegChuTheToChuc
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nguoi_duyet', 'trang_thai_id'], 'integer'],
            [['ma', 'ten_to_chuc', 'ten_thuong_mai', 'ten_tieng_nuoc_ngoai', 'giay_dang_ky_kd', 'loai_hinh_hoat_dong_id', 'ma_so_thue', 'nguoi_dai_dien', 'so_cmtnd', 'ngay_cap', 'noi_cap', 'dia_chi_tru_so', 'website', 'email', 'so_dien_thoai', 'ngay_tao', 'ngay_duyet', 'file_dinh_kem','tinh_thanh_id', 'quan_huyen_id', 'xa_phuong_id'], 'safe'],
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
        $query = RegChuTheToChuc::find();
        $query->leftJoin('tinh_thanh','tinh_thanh.id=tinh_thanh_id');
        $query->leftJoin('quan_huyen','quan_huyen.id=quan_huyen_id');
        $query->leftJoin('xa_phuong','xa_phuong.id=xa_phuong_id');

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
        $query->andFilterWhere([
            'id' => $this->id,
            'ngay_cap' => $this->ngay_cap,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_duyet' => $this->nguoi_duyet,
            'ngay_duyet' => $this->ngay_duyet,
            'trang_thai_id' => $this->trang_thai_id,
//            'tinh_thanh_id' => $this->tinh_thanh_id,
//            'quan_huyen_id' => $this->quan_huyen_id,
//            'xa_phuong_id' => $this->xa_phuong_id,
        ]);

        $query->andFilterWhere(['like', 'reg_chu_the_to_chuc.ma', $this->ma])
            ->andFilterWhere(['like', 'ten_to_chuc', $this->ten_to_chuc])
            ->andFilterWhere(['like', 'ten_thuong_mai', $this->ten_thuong_mai])
            ->andFilterWhere(['like', 'ten_tieng_nuoc_ngoai', $this->ten_tieng_nuoc_ngoai])
            ->andFilterWhere(['like', 'giay_dang_ky_kd', $this->giay_dang_ky_kd])
            ->andFilterWhere(['like', 'loai_hinh_hoat_dong_id', $this->loai_hinh_hoat_dong_id])
            ->andFilterWhere(['like', 'ma_so_thue', $this->ma_so_thue])
            ->andFilterWhere(['like', 'nguoi_dai_dien', $this->nguoi_dai_dien])
            ->andFilterWhere(['like', 'so_cmtnd', $this->so_cmtnd])
            ->andFilterWhere(['like', 'noi_cap', $this->noi_cap])
            ->andFilterWhere(['like', 'dia_chi_tru_so', $this->dia_chi_tru_so])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'so_dien_thoai', $this->so_dien_thoai])
            ->andFilterWhere(['like', 'file_dinh_kem', $this->file_dinh_kem]);


        $query->andFilterWhere(['like','tinh_thanh.ten',$this->tinh_thanh_id])
                ->andFilterWhere(['like','quan_huyen.ten',$this->quan_huyen_id])
                ->andFilterWhere(['like','xa_phuong.ten',$this->xa_phuong_id]);

        return $dataProvider;
    }
}
