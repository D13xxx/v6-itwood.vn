<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RegHoSoGoChiTiet;

/**
 * RegHoSoGoChiTietSearch represents the model behind the search form of `common\models\RegHoSoGoChiTiet`.
 */
class RegHoSoGoChiTietSearch extends RegHoSoGoChiTiet
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'reg_ho_so_go_id', 'reg_lo_rung_id', 'so_luong', 'trang_thai_id', 'reg_ho_so_xin_khai_thac_id'], 'integer'],
            [['cap_duong_kinh_trung_binh', 'chieu_dai', 'khoi_luong'], 'number'],
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
        $query = RegHoSoGoChiTiet::find();

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
            'reg_ho_so_go_id' => $this->reg_ho_so_go_id,
            'reg_lo_rung_id' => $this->reg_lo_rung_id,
            'cap_duong_kinh_trung_binh' => $this->cap_duong_kinh_trung_binh,
            'chieu_dai' => $this->chieu_dai,
            'so_luong' => $this->so_luong,
            'khoi_luong' => $this->khoi_luong,
            'trang_thai_id' => $this->trang_thai_id,
            'reg_ho_so_xin_khai_thac_id' => $this->reg_ho_so_xin_khai_thac_id,
        ]);

        return $dataProvider;
    }
}
