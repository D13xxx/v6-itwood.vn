<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reg_ho_so_xin_khai_thac_tuan_thu".
 *
 * @property int $id
 * @property int $reg_ho_so_xin_khai_thac_id
 * @property int $reg_trach_nhiem_tuan_thu_id
 * @property int $gia_tri
 * @property string $file_dinh_kem
 * @property int $reg_lo_rung_id
 */
class RegHoSoXinKhaiThacTuanThu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reg_ho_so_xin_khai_thac_tuan_thu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_ho_so_xin_khai_thac_id', 'reg_trach_nhiem_tuan_thu_id', 'gia_tri', 'reg_lo_rung_id'], 'integer'],
            [['file_dinh_kem'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'reg_ho_so_xin_khai_thac_id' => Yii::t('common', 'Hồ sơ đăng ký khai thác'),
            'reg_trach_nhiem_tuan_thu_id' => Yii::t('common', 'Trách nhiệm tuân thủ'),
            'gia_tri' => Yii::t('common', 'Có/Không'),
            'file_dinh_kem' => Yii::t('common', 'Tệp đính kèm'),
            'reg_lo_rung_id' => Yii::t('common', 'Lô rừng trồng'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\RegHoSoXinKhaiThacTuanThuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\RegHoSoXinKhaiThacTuanThuQuery(get_called_class());
    }

    public function getLoRung()
    {
        return $this->hasOne(RegLoRung::className(),['id'=>'reg_lo_rung_id']);
    }

    public function getTrachNhiemTuanThu()
    {
        return $this->hasOne(SysTrachNhiemTuanThu::className(),['id'=>'reg_trach_nhiem_tuan_thu_id']);
    }
}
