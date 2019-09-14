<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RegHoSoXnKhaiThacKhongDuyet;

/**
 * RegHoSoXnKhaiThacKhongDuyetSearch represents the model behind the search form of `common\models\RegHoSoXnKhaiThacKhongDuyet`.
 */
class RegHoSoXnKhaiThacKhongDuyetSearch extends RegHoSoXnKhaiThacKhongDuyet
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'reg_ho_so_xin_khai_thac_id', 'nguoi_lap'], 'integer'],
            [['ly_do', 'ngay_lap'], 'safe'],
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
        $query = RegHoSoXnKhaiThacKhongDuyet::find();

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
            'reg_ho_so_xin_khai_thac_id' => $this->reg_ho_so_xin_khai_thac_id,
            'nguoi_lap' => $this->nguoi_lap,
            'ngay_lap' => $this->ngay_lap,
        ]);

        $query->andFilterWhere(['like', 'ly_do', $this->ly_do]);

        return $dataProvider;
    }
}
