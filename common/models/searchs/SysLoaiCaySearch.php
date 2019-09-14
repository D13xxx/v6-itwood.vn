<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SysLoaiCay;

/**
 * SysLoaiCaySearch represents the model behind the search form of `common\models\SysLoaiCay`.
 */
class SysLoaiCaySearch extends SysLoaiCay
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nhom_cay_trong_id', 'tuoi_toi_thieu', 'trang_thai'], 'integer'],
            [['ma', 'ten', 'ten_khoa_hoc'], 'safe'],
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
        $query = SysLoaiCay::find();

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
            'nhom_cay_trong_id' => $this->nhom_cay_trong_id,
            'tuoi_toi_thieu' => $this->tuoi_toi_thieu,
            'trang_thai' => $this->trang_thai,
        ]);

        $query->andFilterWhere(['like', 'ma', $this->ma])
            ->andFilterWhere(['like', 'ten', $this->ten])
            ->andFilterWhere(['like', 'ten_khoa_hoc', $this->ten_khoa_hoc]);

        return $dataProvider;
    }
}
