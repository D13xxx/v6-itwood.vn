<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reg_ho_so_go_giao_dich".
 *
 * @property int $id
 * @property int $reg_chu_the_cu_id
 * @property int $reg_chu_the_moi_id
 * @property string $ten_chu_the
 * @property string $so_cmtnd
 * @property string $ma_so_thue
 * @property int $loai_chu_the_id
 * @property string $so_hoa_don
 * @property string $ngay_hoa_don
 * @property string $file_dinh_kem
 * @property string $ngay_ban
 * @property string $ngay_mua
 * @property int $reg_ho_so_go_id
 */
class RegHoSoGoGiaoDich extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reg_ho_so_go_giao_dich';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_chu_the_cu_id', 'reg_chu_the_moi_id', 'loai_chu_the_id', 'reg_ho_so_go_id'], 'integer'],
            [['ngay_hoa_don', 'ngay_ban', 'ngay_mua'], 'safe'],
            [['ten_chu_the', 'so_hoa_don', 'file_dinh_kem'], 'string', 'max' => 255],
            [['so_cmtnd', 'ma_so_thue'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'reg_chu_the_cu_id' => Yii::t('common', 'Chủ thể cũ'),
            'reg_chu_the_moi_id' => Yii::t('common', 'Chủ thể mới'),
            'ten_chu_the' => Yii::t('common', 'Tên chủ thể'),
            'so_cmtnd' => Yii::t('common', 'Số CMTND'),
            'ma_so_thue' => Yii::t('common', 'Mã số thuế'),
            'loai_chu_the_id' => Yii::t('common', 'Loại chủ thể'),
            'so_hoa_don' => Yii::t('common', 'Số hóa đơn'),
            'ngay_hoa_don' => Yii::t('common', 'Ngày hóa đơn'),
            'file_dinh_kem' => Yii::t('common', 'Tệp đính kèm'),
            'ngay_ban' => Yii::t('common', 'Ngày bán'),
            'ngay_mua' => Yii::t('common', 'Ngày mua'),
            'reg_ho_so_go_id' => Yii::t('common', 'Hồ sơ gỗ'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\RegHoSoGoGiaoDichQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\RegHoSoGoGiaoDichQuery(get_called_class());
    }
}
