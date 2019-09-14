<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reg_ho_so_xin_khai_thac".
 *
 * @property int $id
 * @property double $dien_tich_khai_thac
 * @property string $ngay_bat_dau
 * @property string $ngay_ket_thuc
 * @property int $chu_the_id
 * @property string $ngay_lap
 * @property int $trang_thai_id
 * @property int $nguoi_duyet_id
 * @property string $ngay_duyet
 * @property string $ma
 */
class RegHoSoXinKhaiThac extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TT_HOSO_MOI =1;
    const TT_HOSO_DENGHIDUYET=2;
    const TT_HOSO_DUOCDUYET =3;
    const TT_HOSO_KHONGDUYET=4;
    const TT_HOSO_DACHUYENDOI =-1;

    public static function TT_HOSO_ARRAY()
    {
        return [
            self::TT_HOSO_DACHUYENDOI => Yii::t('frontend','Hồ sơ đã chuyển đổi'),
            self::TT_HOSO_MOI => Yii::t('frontend','Hồ sơ mới'),
            self::TT_HOSO_DENGHIDUYET => Yii::t('frontend','Hồ sơ đề nghị duyệt'),
            self::TT_HOSO_DUOCDUYET => Yii::t('frontend','Hồ sơ đã duyệt'),
            self::TT_HOSO_KHONGDUYET => Yii::t('frontend','Hồ sơ không được duyệt')
        ];
    }

    public static function TT_HOSO_LABEL()
    {
        return [
            self::TT_HOSO_MOI => '<span class="label label-info">'.Yii::t('frontend','Hồ sơ mới').'</span>',
            self::TT_HOSO_DENGHIDUYET => '<span class="label label-success">'.Yii::t('frontend','Hồ sơ đề nghị duyệt').'</span>',
            self::TT_HOSO_DUOCDUYET => '<span class="label label-primary">'.Yii::t('frontend','Hồ sơ đã duyệt').'</span>',
            self::TT_HOSO_KHONGDUYET => '<span class="label label-danger">'.Yii::t('frontend','Hồ sơ không được duyệt').'</span>',
            self::TT_HOSO_DACHUYENDOI => '<span class="label label-default">'.Yii::t('frontend','Hồ sơ đã chuyển đổi').'</span>'
        ];
    }

    public static function tableName()
    {
        return 'reg_ho_so_xin_khai_thac';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dien_tich_khai_thac'], 'number'],
            [['ngay_bat_dau', 'ngay_ket_thuc', 'ngay_lap', 'ngay_duyet'], 'safe'],
            [['chu_the_id', 'trang_thai_id', 'nguoi_duyet_id','loai_hinh_chu_the_id','tinh_thanh_id','quan_huyen_id','xa_phuong_id','da_lap_ho_so_go'], 'integer'],
            [['ma'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'dien_tich_khai_thac' => Yii::t('common', 'Tổng diện tích KT (ha)'),
            'ngay_bat_dau' => Yii::t('common', 'Ngày bắt đầu'),
            'ngay_ket_thuc' => Yii::t('common', 'Ngày kết thúc'),
            'chu_the_id' => Yii::t('common', 'Chủ sở hữu'),
            'ngay_lap' => Yii::t('common', 'Ngày lập'),
            'trang_thai_id' => Yii::t('common', 'Trạng thái'),
            'nguoi_duyet_id' => Yii::t('common', 'Người duyệt'),
            'ngay_duyet' => Yii::t('common', 'Ngày duyệt'),
            'ma' => Yii::t('common', 'Mã hồ sơ'),
            'loai_hinh_chu_the_id' => Yii::t('common', 'loai_hinh_chu_the_id'),
            'tinh_thanh_id' => Yii::t('common', 'Tỉnh thành'),
            'quan_huyen_id' => Yii::t('common', 'Quận huyện'),
            'xa_phuong_id' => Yii::t('common', 'Xã phường'),
            'da_lap_ho_so_go' => Yii::t('common', 'Đã lập hồ sơ gỗ'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\RegHoSoXinKhaiThacQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\RegHoSoXinKhaiThacQuery(get_called_class());
    }

    public static function TongKhoiLuongDuKien($idHoSoXinKhaiThac)
    {
        $query = RegHoSoXinKhaiThacBkls::find()->where(['reg_ho_so_xin_khai_thac_id'=>$idHoSoXinKhaiThac]);
        $tongKhoiLuong = $query->sum('san_luong_du_kien');
        return $tongKhoiLuong;
    }
}
