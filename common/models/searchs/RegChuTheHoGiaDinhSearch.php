<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RegChuTheHoGiaDinh;

/**
 * RegChuTheHoGiaDinhSearch represents the model behind the search form of `common\models\RegChuTheHoGiaDinh`.
 */
class RegChuTheHoGiaDinhSearch extends RegChuTheHoGiaDinh
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'trang_thai_id', 'nguoi_duyet', 'nguoi_sua'], 'integer'],
            [['ma', 'ten', 'noi_thuong_tru', 'so_cmtnd', 'ngay_cap', 'noi_cap', 'ngay_tao', 'ngay_duyet', 'ngay_sua', 'loai_hinh_hoat_dong_id', 'file_dinh_kem', 'so_dien_thoai', 'email','tinh_thanh_id', 'quan_huyen_id', 'xa_phuong_id'], 'safe'],
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
        $query = RegChuTheHoGiaDinh::find();
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
//            'tinh_thanh_id' => $this->tinh_thanh_id,
//            'quan_huyen_id' => $this->quan_huyen_id,
//            'xa_phuong_id' => $this->xa_phuong_id,
            'ngay_cap' => $this->ngay_cap,
            'trang_thai_id' => $this->trang_thai_id,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_duyet' => $this->nguoi_duyet,
            'ngay_duyet' => $this->ngay_duyet,
            'nguoi_sua' => $this->nguoi_sua,
            'ngay_sua' => $this->ngay_sua,
        ]);

        $query->andFilterWhere(['like', 'reg_chu_the_ho_gia_dinh.ma', $this->ma])
            ->andFilterWhere(['like', 'reg_chu_the_ho_gia_dinh.ten', $this->ten])
            ->andFilterWhere(['like', 'noi_thuong_tru', $this->noi_thuong_tru])
            ->andFilterWhere(['like', 'so_cmtnd', $this->so_cmtnd])
            ->andFilterWhere(['like', 'noi_cap', $this->noi_cap])
            ->andFilterWhere(['like', 'loai_hinh_hoat_dong_id', $this->loai_hinh_hoat_dong_id])
            ->andFilterWhere(['like', 'file_dinh_kem', $this->file_dinh_kem])
            ->andFilterWhere(['like', 'so_dien_thoai', $this->so_dien_thoai])
            ->andFilterWhere(['like', 'email', $this->email]);

        $query->andFilterWhere(['like','tinh_thanh.ten',$this->tinh_thanh_id])
            ->andFilterWhere(['like','quan_huyen.ten',$this->quan_huyen_id])
            ->andFilterWhere(['like','xa_phuong.ten',$this->xa_phuong_id]);

        return $dataProvider;
    }
}
