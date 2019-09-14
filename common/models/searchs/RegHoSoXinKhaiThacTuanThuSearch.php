<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RegHoSoXinKhaiThacTuanThu;

/**
 * RegHoSoXinKhaiThacTuanThuSearch represents the model behind the search form of `common\models\RegHoSoXinKhaiThacTuanThu`.
 */
class RegHoSoXinKhaiThacTuanThuSearch extends RegHoSoXinKhaiThacTuanThu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'reg_ho_so_xin_khai_thac_id', 'reg_trach_nhiem_tuan_thu_id', 'gia_tri', 'reg_lo_rung_id'], 'integer'],
            [['file_dinh_kem'], 'safe'],
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
        $query = RegHoSoXinKhaiThacTuanThu::find();

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
            'reg_trach_nhiem_tuan_thu_id' => $this->reg_trach_nhiem_tuan_thu_id,
            'gia_tri' => $this->gia_tri,
            'reg_lo_rung_id' => $this->reg_lo_rung_id,
        ]);

        $query->andFilterWhere(['like', 'file_dinh_kem', $this->file_dinh_kem]);

        return $dataProvider;
    }
}
