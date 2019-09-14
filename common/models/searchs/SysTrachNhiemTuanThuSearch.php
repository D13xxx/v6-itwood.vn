<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SysTrachNhiemTuanThu;

/**
 * SysTrachNhiemTuanThuSearch represents the model behind the search form of `common\models\SysTrachNhiemTuanThu`.
 */
class SysTrachNhiemTuanThuSearch extends SysTrachNhiemTuanThu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'loai_hinh_chu_the_id','loai_rung_id','nguoi_tao', 'nguoi_sua', 'trang_thai_id'], 'integer'],
            [['ten', 'ngay_tao', 'ngay_sua',], 'safe'],
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
        $query = SysTrachNhiemTuanThu::find();

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
            'loai_hinh_chu_the_id' => $this->loai_hinh_chu_the_id,
            'loai_rung_id' => $this->loai_rung_id,
            'nguoi_tao' => $this->nguoi_tao,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_sua' => $this->nguoi_sua,
            'ngay_sua' => $this->ngay_sua,
            'trang_thai_id' => $this->trang_thai_id,
        ]);

        $query->andFilterWhere(['like', 'ten', $this->ten]);

        return $dataProvider;
    }
}
