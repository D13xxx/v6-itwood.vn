<?php

namespace common\models\searchs;

use common\models\Dungchung;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RegHoSoXinKhaiThac;

/**
 * RegHoSoXinKhaiThacSearch represents the model behind the search form of `common\models\RegHoSoXinKhaiThac`.
 */
class RegHoSoXinKhaiThacSearch extends RegHoSoXinKhaiThac
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'trang_thai_id', 'nguoi_duyet_id','loai_hinh_chu_the_id'], 'integer'],
            [['dien_tich_khai_thac'], 'number'],
            [['ngay_bat_dau', 'ngay_ket_thuc', 'ngay_lap', 'ngay_duyet','ma','chu_the_id'], 'safe'],
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
        $query = RegHoSoXinKhaiThac::find();
        $query->leftJoin('reg_chu_the_to_chuc','reg_chu_the_to_chuc.id=chu_the_id');
        $query->leftJoin('reg_chu_the_ho_gia_dinh','reg_chu_the_ho_gia_dinh.id=chu_the_id');
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
            'dien_tich_khai_thac' => $this->dien_tich_khai_thac,
//            'ngay_bat_dau' => $this->ngay_bat_dau,
//            'ngay_ket_thuc' => $this->ngay_ket_thuc,
//            'chu_the_id' => $this->chu_the_id,
//            'ngay_lap' => $this->ngay_lap,
            'reg_ho_so_xin_khai_thac.trang_thai_id' => $this->trang_thai_id,
            'nguoi_duyet_id' => $this->nguoi_duyet_id,
            'loai_hinh_chu_the_id' => $this->loai_hinh_chu_the_id,
//            'ngay_duyet' => $this->ngay_duyet,
        ]);

        $query->andFilterWhere(['like','reg_ho_so_xin_khai_thac.ma',$this->ma]);

        if(!empty($this->ngay_bat_dau)){
            $query->andFilterWhere(['like','ngay_bat_dau',Dungchung::convert_to_date($this->ngay_bat_dau)]);
        }
        if(!empty($this->ngay_ket_thuc)){
            $query->andFilterWhere(['like','ngay_ket_thuc',Dungchung::convert_to_date($this->ngay_ket_thuc)]);
        }
        if(!empty($this->ngay_lap)){
            $query->andFilterWhere(['like','ngay_lap',Dungchung::convert_to_date($this->ngay_lap)]);
        }
        if(!empty($this->ngay_duyet)){
            $query->andFilterWhere(['like','ngay_duyet',Dungchung::convert_to_date($this->ngay_duyet)]);
        }

        if(!empty($this->chu_the_id)){
            $query->andFilterWhere(['or',['like','reg_chu_the_to_chuc.ten_to_chuc',$this->chu_the_id],['like','reg_chu_the_ho_gia_dinh.ten',$this->chu_the_id]]);
        }

        return $dataProvider;
    }
}
