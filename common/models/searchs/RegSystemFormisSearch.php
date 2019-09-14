<?php

namespace common\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RegSystemFormis;

/**
 * RegSystemFormisSearch represents the model behind the search form about `common\models\RegSystemFormis`.
 */
class RegSystemFormisSearch extends RegSystemFormis
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'trang_thai_id', 'nguoi_khoi_tao'], 'integer'],
            [['url', 'bang_du_lieu', 'ngay_khoi_tao'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = RegSystemFormis::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'trang_thai_id' => $this->trang_thai_id,
            'ngay_khoi_tao' => $this->ngay_khoi_tao,
            'nguoi_khoi_tao' => $this->nguoi_khoi_tao,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'bang_du_lieu', $this->bang_du_lieu]);

        return $dataProvider;
    }
}
