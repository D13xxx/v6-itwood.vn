<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RegLoRungPhucTra;

/**
 * RegLoRungPhucTraSearch represents the model behind the search form of `common\models\RegLoRungPhucTra`.
 */
class RegLoRungPhucTraSearch extends RegLoRungPhucTra
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'reg_lo_rung_id', 'nguoi_tao'], 'integer'],
            [['reg_lo_rung_ma_cu', 'reg_lo_rung_ma_moi', 'ngay_tao'], 'safe'],
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
        $query = RegLoRungPhucTra::find();

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
            'reg_lo_rung_id' => $this->reg_lo_rung_id,
            'nguoi_tao' => $this->nguoi_tao,
            'ngay_tao' => $this->ngay_tao,
        ]);

        $query->andFilterWhere(['like', 'reg_lo_rung_ma_cu', $this->reg_lo_rung_ma_cu])
            ->andFilterWhere(['like', 'reg_lo_rung_ma_moi', $this->reg_lo_rung_ma_moi]);

        return $dataProvider;
    }
}
