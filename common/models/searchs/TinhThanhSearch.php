<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TinhThanh;

/**
 * TinhThanhSearch represents the model behind the search form of `common\models\TinhThanh`.
 */
class TinhThanhSearch extends TinhThanh
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'trang_thai', 'is_delete', 'nguoi_xoa'], 'integer'],
            [['ma', 'ten', 'ngay_xoa'], 'safe'],
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
        $query = TinhThanh::find();

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
            'trang_thai' => $this->trang_thai,
            'is_delete' => $this->is_delete,
            'nguoi_xoa' => $this->nguoi_xoa,
            'ngay_xoa' => $this->ngay_xoa,
        ]);

        $query->andFilterWhere(['like', 'ma', $this->ma])
            ->andFilterWhere(['like', 'ten', $this->ten]);

        return $dataProvider;
    }
}
