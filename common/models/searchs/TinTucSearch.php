<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TinTuc;

/**
 * TinTucSearch represents the model behind the search form of `common\models\TinTuc`.
 */
class TinTucSearch extends TinTuc
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by','tin_noi_bat','so_lan_xem'], 'integer'],
            [['tieu_de', 'tom_tat', 'chi_tiet', 'anh_dai_dien'], 'safe'],
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
        $query = TinTuc::find();

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
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'tin_noi_bat' => $this->tin_noi_bat,
            'so_lan_xem' => $this->so_lan_xem,
        ]);

        $query->andFilterWhere(['like', 'tieu_de', $this->tieu_de])
            ->andFilterWhere(['like', 'tom_tat', $this->tom_tat])
            ->andFilterWhere(['like', 'chi_tiet', $this->chi_tiet])
            ->andFilterWhere(['like', 'anh_dai_dien', $this->anh_dai_dien]);

        return $dataProvider;
    }
}
