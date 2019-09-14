<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RegHoSoXinKhaiThacGiaoDich;

/**
 * RegHoSoXinKhaiThacGiaoDichSearch represents the model behind the search form of `common\models\RegHoSoXinKhaiThacGiaoDich`.
 */
class RegHoSoXinKhaiThacGiaoDichSearch extends RegHoSoXinKhaiThacGiaoDich
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'reg_chu_the_cu_id', 'reg_chu_the_moi_id', 'loai_chu_the_id', 'reg_ho_so_xin_khai_thac_id'], 'integer'],
            [['ten_chu_the', 'so_cmtnd', 'ma_so_thue', 'so_hoa_don', 'ngay_hoa_don', 'file_dinh_kem', 'ngay_ban', 'ngay_mua'], 'safe'],
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
        $query = RegHoSoXinKhaiThacGiaoDich::find();

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
            'reg_chu_the_cu_id' => $this->reg_chu_the_cu_id,
            'reg_chu_the_moi_id' => $this->reg_chu_the_moi_id,
            'loai_chu_the_id' => $this->loai_chu_the_id,
            'ngay_hoa_don' => $this->ngay_hoa_don,
            'ngay_ban' => $this->ngay_ban,
            'ngay_mua' => $this->ngay_mua,
            'reg_ho_so_xin_khai_thac_id' => $this->reg_ho_so_xin_khai_thac_id,
        ]);

        $query->andFilterWhere(['like', 'ten_chu_the', $this->ten_chu_the])
            ->andFilterWhere(['like', 'so_cmtnd', $this->so_cmtnd])
            ->andFilterWhere(['like', 'ma_so_thue', $this->ma_so_thue])
            ->andFilterWhere(['like', 'so_hoa_don', $this->so_hoa_don])
            ->andFilterWhere(['like', 'file_dinh_kem', $this->file_dinh_kem]);

        return $dataProvider;
    }
}
