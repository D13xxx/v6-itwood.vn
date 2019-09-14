<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RegChuTheToChucKhongDuyet;

/**
 * RegChuTheToChucKhongDuyetSearch represents the model behind the search form of `common\models\RegChuTheToChucKhongDuyet`.
 */
class RegChuTheToChucKhongDuyetSearch extends RegChuTheToChucKhongDuyet
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'chu_the_id', 'nguoi_lap'], 'integer'],
            [['ly_do_khong_duyet', 'ngay_lap'], 'safe'],
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
        $query = RegChuTheToChucKhongDuyet::find();

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
            'chu_the_id' => $this->chu_the_id,
            'nguoi_lap' => $this->nguoi_lap,
            'ngay_lap' => $this->ngay_lap,
        ]);

        $query->andFilterWhere(['like', 'ly_do_khong_duyet', $this->ly_do_khong_duyet]);

        return $dataProvider;
    }
}
