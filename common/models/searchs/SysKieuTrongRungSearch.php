<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SysKieuTrongRung;

/**
 * SysKieuTrongRungSearch represents the model behind the search form of `common\models\SysKieuTrongRung`.
 */
class SysKieuTrongRungSearch extends SysKieuTrongRung
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'trang_thai'], 'integer'],
            [['ten'], 'safe'],
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
        $query = SysKieuTrongRung::find();

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
        ]);

        $query->andFilterWhere(['like', 'ten', $this->ten]);

        return $dataProvider;
    }
}
