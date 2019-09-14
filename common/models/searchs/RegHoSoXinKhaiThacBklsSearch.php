<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RegHoSoXinKhaiThacBkls;

/**
 * RegHoSoXinKhaiThacBklsSearch represents the model behind the search form of `common\models\RegHoSoXinKhaiThacBkls`.
 */
class RegHoSoXinKhaiThacBklsSearch extends RegHoSoXinKhaiThacBkls
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'reg_lo_rung_id', 'phuong_thuc_khai_thac_id', 'so_cay_hien_tai', 'trang_thai_id', 'reg_ho_so_xin_khai_thac_id', 'loai_cay_trong_id', 'phuong_thuc_trong_id', 'nam_trong', 'loai_von_dau_tu_id'], 'integer'],
            [['dien_tich_khai_thac', 'tuoi_rung_khai_thac', 'san_luong_du_kien'], 'number'],
            [['d13_cay_pho_bien', 'phuong_an_bao_ve_rung', 'chu_so_huu'], 'safe'],
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
        $query = RegHoSoXinKhaiThacBkls::find();

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
            'dien_tich_khai_thac' => $this->dien_tich_khai_thac,
            'phuong_thuc_khai_thac_id' => $this->phuong_thuc_khai_thac_id,
            'tuoi_rung_khai_thac' => $this->tuoi_rung_khai_thac,
            'so_cay_hien_tai' => $this->so_cay_hien_tai,
            'san_luong_du_kien' => $this->san_luong_du_kien,
            'trang_thai_id' => $this->trang_thai_id,
            'reg_ho_so_xin_khai_thac_id' => $this->reg_ho_so_xin_khai_thac_id,
            'loai_cay_trong_id' => $this->loai_cay_trong_id,
            'phuong_thuc_trong_id' => $this->phuong_thuc_trong_id,
            'nam_trong' => $this->nam_trong,
            'loai_von_dau_tu_id' => $this->loai_von_dau_tu_id,
        ]);

        $query->andFilterWhere(['like', 'd13_cay_pho_bien', $this->d13_cay_pho_bien])
            ->andFilterWhere(['like', 'phuong_an_bao_ve_rung', $this->phuong_an_bao_ve_rung])
            ->andFilterWhere(['like', 'chu_so_huu', $this->chu_so_huu]);

        return $dataProvider;
    }
}
