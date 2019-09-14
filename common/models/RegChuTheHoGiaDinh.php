<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reg_chu_the_ho_gia_dinh".
 *
 * @property int $id
 * @property string $ma
 * @property string $ten
 * @property string $noi_thuong_tru
 * @property int $tinh_thanh_id
 * @property int $quan_huyen_id
 * @property int $xa_phuong_id
 * @property string $so_cmtnd
 * @property string $ngay_cap
 * @property string $noi_cap
 * @property int $trang_thai_id
 * @property string $ngay_tao
 * @property int $nguoi_duyet
 * @property string $ngay_duyet
 * @property int $nguoi_sua
 * @property string $ngay_sua
 * @property string $loai_hinh_hoat_dong_id
 * @property string $file_dinh_kem
 * @property string $ma_so_thue
 */
class RegChuTheHoGiaDinh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TT_NEWREG = 3;
    const TT_ACTIVE = 1;
    const TT_NOACTIVE = 2;
    const TT_ISDELETE = -1;

    const TRANG_THAI_ARRAY = array(
        RegChuTheHoGiaDinh::TT_ACTIVE => 'Đã duyệt',
        RegChuTheHoGiaDinh::TT_NEWREG =>'Đề nghị duyệt',
        RegChuTheHoGiaDinh::TT_NOACTIVE =>'Không duyệt',
        RegChuTheHoGiaDinh::TT_ISDELETE =>'Đánh dấu xóa',
    );

    const CHU_RUNG = 1;
    const CHU_KHAI_THAC = 2;
    const CHU_CHE_BIEN = 3;
    const CHU_THUONG_MAI = 4;

    public $loai_hinh_hoat_dong_id_array;
    /**
     * @var array
     */
    const LOAI_HINH_HOAT_DONG_ARRAY = array(
        RegChuTheHoGiaDinh::CHU_RUNG => 'Chủ rừng',
        RegChuTheHoGiaDinh::CHU_KHAI_THAC => 'Khai thác, vận chuyển',
        RegChuTheHoGiaDinh::CHU_CHE_BIEN => 'Chế biến',
        RegChuTheHoGiaDinh::CHU_THUONG_MAI => 'Thương mại',
    );

    public static function tableName()
    {
        return 'reg_chu_the_ho_gia_dinh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten','so_cmtnd','noi_cap','ngay_cap','noi_thuong_tru','tinh_thanh_id','quan_huyen_id','xa_phuong_id','loai_hinh_hoat_dong_id_array','file_dinh_kem'],'required'],
            [['tinh_thanh_id', 'quan_huyen_id', 'xa_phuong_id', 'trang_thai_id', 'nguoi_duyet', 'nguoi_sua'], 'integer'],
            [['ngay_cap', 'ngay_tao', 'ngay_duyet', 'ngay_sua'], 'safe'],
            [['ma', 'so_cmtnd', 'loai_hinh_hoat_dong_id'], 'string', 'max' => 50],
            [['ten', 'noi_thuong_tru', 'noi_cap','so_dien_thoai','email','ma_so_thue'], 'string', 'max' => 255],
            [['email'],'email'],
            [['file_dinh_kem'],'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'ma' => Yii::t('common', 'Mã chủ thể'),
            'ten' => Yii::t('common', 'Tên (*)'),
            'noi_thuong_tru' => Yii::t('common', 'Nơi thường trú (*)'),
            'tinh_thanh_id' => Yii::t('common', 'Tỉnh thành (*)'),
            'quan_huyen_id' => Yii::t('common', 'Quận huyện (*)'),
            'xa_phuong_id' => Yii::t('common', 'Xã phường (*)'),
            'so_cmtnd' => Yii::t('common', 'Số CMTND (*)'),
            'ngay_cap' => Yii::t('common', 'Ngày cấp (*)'),
            'noi_cap' => Yii::t('common', 'Nơi cấp (*)'),
            'trang_thai_id' => Yii::t('common', 'Trạng thái'),
            'ngay_tao' => Yii::t('common', 'Ngày tạo'),
            'nguoi_duyet' => Yii::t('common', 'Người duyệt'),
            'ngay_duyet' => Yii::t('common', 'Ngày duyệt'),
            'nguoi_sua' => Yii::t('common', 'Người sửa'),
            'ngay_sua' => Yii::t('common', 'Ngày sửa'),
            'loai_hinh_hoat_dong_id' => Yii::t('common', 'Loại hình hoạt động (*)'),
            'file_dinh_kem' => Yii::t('common', 'Ảnh CMTND (*)'),
            'so_dien_thoai' => Yii::t('common', 'Số điện thoại'),
            'email' => Yii::t('common', 'Email'),
            'loai_hinh_hoat_dong_id_array' => Yii::t('common', 'Loại hình hoạt động (*)'),
            'ma_so_thue' => Yii::t('common', 'Mã số thuế'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\RegChuTheHoGiaDinhQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\RegChuTheHoGiaDinhQuery(get_called_class());
    }

    public function getTinhThanh()
    {
        return $this->hasOne(TinhThanh::className(),['id'=>'tinh_thanh_id']);
    }
    public function getQuanHuyen()
    {
        return $this->hasOne(QuanHuyen::className(),['id'=>'quan_huyen_id']);
    }
    public function getXaPhuong()
    {
        return $this->hasOne(XaPhuong::className(),['id'=>'xa_phuong_id']);
    }

    public function getNguoiDuyet()
    {
        return $this->hasOne(User::className(),['id'=>'nguoi_duyet']);
    }
}
