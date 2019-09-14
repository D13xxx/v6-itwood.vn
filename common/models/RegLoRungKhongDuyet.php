<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reg_lo_rung_khong_duyet".
 *
 * @property int $id
 * @property string $ly_do
 * @property int $reg_lo_rung_id
 * @property int $nguoi_lap
 * @property string $ngay_lap
 */
class RegLoRungKhongDuyet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reg_lo_rung_khong_duyet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ly_do'], 'string'],
            [['reg_lo_rung_id', 'nguoi_lap'], 'integer'],
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
            'ly_do' => Yii::t('common', 'Nguyên nhân không duyệt'),
            'reg_lo_rung_id' => Yii::t('common', 'Lô rừng'),
            'nguoi_lap' => Yii::t('common', 'Người lập'),
            'ngay_lap' => Yii::t('common', 'Ngày lập'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\RegLoRungKhongDuyetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\RegLoRungKhongDuyetQuery(get_called_class());
    }

    public function getNguoiLap()
    {
        return $this->hasOne(User::className(),['id'=>'nguoi_lap']);
    }
}
