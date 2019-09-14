<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "reg_ho_so_xn_khai_thac_khong_duyet".
 *
 * @property int $id
 * @property int $reg_ho_so_xin_khai_thac_id
 * @property string $ly_do
 * @property int $nguoi_lap
 * @property string $ngay_lap
 */
class RegHoSoXnKhaiThacKhongDuyet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reg_ho_so_xn_khai_thac_khong_duyet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_ho_so_xin_khai_thac_id', 'nguoi_lap'], 'integer'],
            [['ly_do'], 'string'],
            [['ngay_lap'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'reg_ho_so_xin_khai_thac_id' => Yii::t('common', 'Reg Ho So Xin Khai Thac ID'),
            'ly_do' => Yii::t('common', 'Lý do'),
            'nguoi_lap' => Yii::t('common', 'Người lập'),
            'ngay_lap' => Yii::t('common', 'Ngày lập'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\RegHoSoXnKhaiThacKhongDuyetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\RegHoSoXnKhaiThacKhongDuyetQuery(get_called_class());
    }

    public static function KhongDuyet($idHoSoKT)
    {
        $query = RegHoSoXnKhaiThacKhongDuyet::find()->where(['reg_ho_so_xin_khai_thac_id'=>$idHoSoKT]);
        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination'=>['pageSize' => 20,]
        ]);

        return $dataProvider;
    }

    public function getNguoiDung()
    {
        return $this->hasOne(User::className(),['id'=>'nguoi_lap']);
    }
}
