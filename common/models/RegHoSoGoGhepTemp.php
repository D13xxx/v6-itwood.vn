<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reg_ho_so_go_ghep_temp".
 *
 * @property int $id
 * @property int $reg_ho_so_go_id
 * @property int $reg_lo_rung_id
 * @property double $cap_duong_kinh_trung_binh
 * @property double $chieu_dai
 * @property int $so_luong
 * @property double $khoi_luong
 * @property int $trang_thai_id
 * @property int $reg_ho_so_xin_khai_thac_id
 * @property double $khoi_luong_da_dung
 * @property double $reg_ho_so_go_chi_tiet_id
 */
class RegHoSoGoGhepTemp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reg_ho_so_go_ghep_temp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_ho_so_go_id', 'reg_lo_rung_id', 'so_luong', 'trang_thai_id', 'reg_ho_so_xin_khai_thac_id','reg_chu_the_id','loai_chu_the_id','reg_ho_so_go_chi_tiet_id'], 'integer'],
            [['cap_duong_kinh_trung_binh', 'chieu_dai', 'khoi_luong', 'khoi_luong_da_dung'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'reg_ho_so_go_id' => Yii::t('common', 'Reg Ho So Go ID'),
            'reg_lo_rung_id' => Yii::t('common', 'Reg Lo Rung ID'),
            'cap_duong_kinh_trung_binh' => Yii::t('common', 'Cap Duong Kinh Trung Binh'),
            'chieu_dai' => Yii::t('common', 'Chieu Dai'),
            'so_luong' => Yii::t('common', 'So Luong'),
            'khoi_luong' => Yii::t('common', 'Khoi Luong'),
            'trang_thai_id' => Yii::t('common', 'Trang Thai ID'),
            'reg_ho_so_xin_khai_thac_id' => Yii::t('common', 'Reg Ho So Xin Khai Thac ID'),
            'khoi_luong_da_dung' => Yii::t('common', 'Khoi Luong Da Dung'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\RegHoSoGoGhepTempQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\RegHoSoGoGhepTempQuery(get_called_class());
    }
}
