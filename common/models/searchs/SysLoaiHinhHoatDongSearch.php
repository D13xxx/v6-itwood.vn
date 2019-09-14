<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SysLoaiHinhHoatDong;

/**
 * SysLoaiHinhHoatDongSearch represents the model behind the search form of `common\models\SysLoaiHinhHoatDong`.
 */
class SysLoaiHinhHoatDongSearch extends SysLoaiHinhHoatDong
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'trang_thai_id', 'is_del', 'nguoi_tao_id', 'nguoi_sua_id'], 'integer'],
            [['ten', 'ngay_tao', 'ngay_sua'], 'safe'],
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
        $query = SysLoaiHinhHoatDong::find();

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
            'trang_thai_id' => $this->trang_thai_id,
            'is_del' => $this->is_del,
            'nguoi_tao_id' => $this->nguoi_tao_id,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_sua_id' => $this->nguoi_sua_id,
            'ngay_sua' => $this->ngay_sua,
        ]);

        $query->andFilterWhere(['like', 'ten', $this->ten]);

        return $dataProvider;
    }
}
