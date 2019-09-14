<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RegQuyenSuDungDat;

/**
 * RegQuyenSuDungDatSearch represents the model behind the search form of `common\models\RegQuyenSuDungDat`.
 */
class RegQuyenSuDungDatSearch extends RegQuyenSuDungDat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quyen_su_dung_dat_id', 'trang_thai_id', 'chu_the_id', 'loai_chu_the_id'], 'integer'],
            [['so_van_ban', 'ngay_ban_hanh', 'so_vao_so', 'co_quan_ban_hanh','ma'], 'safe'],
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
        $query = RegQuyenSuDungDat::find();

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
            'quyen_su_dung_dat_id' => $this->quyen_su_dung_dat_id,
            'ngay_ban_hanh' => $this->ngay_ban_hanh,
            'trang_thai_id' => $this->trang_thai_id,
            'chu_the_id' => $this->chu_the_id,
            'loai_chu_the_id' => $this->loai_chu_the_id,
        ]);

        $query->andFilterWhere(['like', 'so_van_ban', $this->so_van_ban])
            ->andFilterWhere(['like', 'so_vao_so', $this->so_vao_so])
            ->andFilterWhere(['like', 'ma', $this->ma])
            ->andFilterWhere(['like', 'co_quan_ban_hanh', $this->co_quan_ban_hanh]);

        return $dataProvider;
    }
}
