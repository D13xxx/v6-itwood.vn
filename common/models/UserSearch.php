<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form of `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */

    public $nhom_tai_khoan;

    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'user_cha_id', 'reg_chu_the_id', 'loai_chu_the_id'], 'integer'],
            [['nhom_tai_khoan','sys_tinh_thanh_id', 'sys_quan_huyen_id', 'sys_xa_phuong_id', 'username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'fullname'], 'safe'],
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
//        $tinhThanhArray = explode(';',$this->sys_tinh_thanh_id);
        $query = User::find();
        $query->leftJoin('tinh_thanh','tinh_thanh.id = sys_tinh_thanh_id');
        $query->leftJoin('quan_huyen','quan_huyen.id=sys_quan_huyen_id');
        $query->leftJoin('xa_phuong','xa_phuong.id=sys_xa_phuong_id');
        $query->leftJoin('auth_assignment','auth_assignment.user_id=user.id');
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
            'user.id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
//            'sys_tinh_thanh_id' => $this->sys_tinh_thanh_id,
//            'sys_quan_huyen_id' => $this->sys_quan_huyen_id,
//            'sys_xa_phuong_id' => $this->sys_xa_phuong_id,
            'user_cha_id' => $this->user_cha_id,
            'reg_chu_the_id' => $this->reg_chu_the_id,
            'loai_chu_the_id' => $this->loai_chu_the_id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'tinh_thanh.ten', $this->sys_tinh_thanh_id])
            ->andFilterWhere(['like', 'quan_huyen.ten', $this->sys_quan_huyen_id])
            ->andFilterWhere(['like', 'auth_assignment.item_name', $this->nhom_tai_khoan])
            ->andFilterWhere(['like', 'xa_phuong.ten', $this->sys_xa_phuong_id]);

//        if($params['UserSearch']['nhom_tai_khoan']!='(không có)'){
//            $query->andFilterWhere(['like', 'auth_assignment.item_name', $this->nhom_tai_khoan]);
//        } else {
//            $query->andFilterWhere(['nhom_tai_khoan'=>null]);
//        }

        return $dataProvider;
    }
}
