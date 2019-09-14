<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reg_chu_the_ho_gia_dinh_khong_duyet".
 *
 * @property int $id
 * @property int $chu_the_id
 * @property string $ly_do_khong_duyet
 * @property int $nguoi_lap
 * @property string $ngay_lap
 */
class RegChuTheHoGiaDinhKhongDuyet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reg_chu_the_ho_gia_dinh_khong_duyet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chu_the_id', 'nguoi_lap'], 'integer'],
            [['ly_do_khong_duyet'], 'string'],
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
            'chu_the_id' => Yii::t('common', 'Chủ thể'),
            'ly_do_khong_duyet' => Yii::t('common', 'Lý do không duyệt'),
            'nguoi_lap' => Yii::t('common', 'Người lập'),
            'ngay_lap' => Yii::t('common', 'Ngày lập'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\RegChuTheHoGiaDinhKhongDuyetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\RegChuTheHoGiaDinhKhongDuyetQuery(get_called_class());
    }

    public function getNguoiLap()
    {
        return $this->hasOne(User::className(),['id'=>'nguoi_lap']);
    }
}
