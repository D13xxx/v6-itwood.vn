<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RegHoSoGo;

/**
 * RegHoSoGoSearch represents the model behind the search form of `common\models\RegHoSoGo`.
 */
class RegHoSoGoSearch extends RegHoSoGo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'reg_chu_the_id', 'trang_thai_id', 'nguoi_duyet','reg_loai_hinh_chu_the'], 'integer'],
            [['ma', 'ngay_lap', 'ngay_duyet'], 'safe'],
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
        $query = RegHoSoGo::find();

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
            'reg_chu_the_id' => $this->reg_chu_the_id,
            'ngay_lap' => $this->ngay_lap,
            'trang_thai_id' => $this->trang_thai_id,
            'nguoi_duyet' => $this->nguoi_duyet,
            'ngay_duyet' => $this->ngay_duyet,
            'reg_loai_hinh_chu_the' => $this->reg_loai_hinh_chu_the,
        ]);

        $query->andFilterWhere(['like', 'reg_ho_so_go.ma', $this->ma]);

        return $dataProvider;
    }
}
