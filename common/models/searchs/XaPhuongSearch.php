<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\XaPhuong;

/**
 * XaPhuongSearch represents the model behind the search form of `common\models\XaPhuong`.
 */
class XaPhuongSearch extends XaPhuong
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'trang_thai', 'is_delete', 'nguoi_xoa'], 'integer'],
            [['ma', 'ten', 'ngay_xoa','quan_huyen_id', 'tinh_thanh_id'], 'safe'],
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
        $query = XaPhuong::find();
        $query->leftJoin('tinh_thanh','tinh_thanh.id=tinh_thanh_id');
        $query->leftJoin('quan_huyen','quan_huyen.id=quan_huyen_id');

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
//            'quan_huyen_id' => $this->quan_huyen_id,
//            'tinh_thanh_id' => $this->tinh_thanh_id,
            'trang_thai' => $this->trang_thai,
            'is_delete' => $this->is_delete,
            'nguoi_xoa' => $this->nguoi_xoa,
            'ngay_xoa' => $this->ngay_xoa,
        ]);

        $query->andFilterWhere(['like', 'ma', $this->ma])
            ->andFilterWhere(['like', 'ten', $this->ten]);

        $query->andFilterWhere(['like','tinh_thanh.ten',$this->tinh_thanh_id])
            ->andFilterWhere(['like','quan_huyen.ten',$this->quan_huyen_id]);

        return $dataProvider;
    }
}
