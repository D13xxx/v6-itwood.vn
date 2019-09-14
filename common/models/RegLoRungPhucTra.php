<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reg_lo_rung_phuc_tra".
 *
 * @property int $id
 * @property int $reg_lo_rung_id
 * @property string $reg_lo_rung_ma_cu
 * @property string $reg_lo_rung_ma_moi
 * @property int $nguoi_tao
 * @property string $ngay_tao
 */
class RegLoRungPhucTra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reg_lo_rung_phuc_tra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_lo_rung_id', 'nguoi_tao'], 'integer'],
            [['ngay_tao'], 'safe'],
            [['reg_lo_rung_ma_cu', 'reg_lo_rung_ma_moi'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'reg_lo_rung_id' => Yii::t('common', 'Reg Lo Rung ID'),
            'reg_lo_rung_ma_cu' => Yii::t('common', 'Mã lô rừng cũ'),
            'reg_lo_rung_ma_moi' => Yii::t('common', 'Mã lô rừng mới'),
            'nguoi_tao' => Yii::t('common', 'Người lập'),
            'ngay_tao' => Yii::t('common', 'Ngày tạo'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\RegLoRungPhucTraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\RegLoRungPhucTraQuery(get_called_class());
    }

    public function getNguoiTao()
    {
        return $this->hasOne(User::className(),['id'=>'nguoi_tao']);
    }
}
