<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reg_chu_the_to_chuc".
 *
 * @property int $id
 * @property string $ma
 * @property string $ten_to_chuc
 * @property string $ten_thuong_mai
 * @property string $ten_tieng_nuoc_ngoai
 * @property string $giay_dang_ky_kd
 * @property string $loai_hinh_hoat_dong_id
 * @property string $ma_so_thue
 * @property string $nguoi_dai_dien
 * @property string $so_cmtnd
 * @property string $ngay_cap
 * @property string $noi_cap
 * @property string $dia_chi_tru_so
 * @property string $website
 * @property string $email
 * @property string $so_dien_thoai
 * @property string $ngay_tao
 * @property int $nguoi_duyet
 * @property string $ngay_duyet
 * @property int $trang_thai_id
 * @property int $tinh_thanh_id
 * @property int $quan_huyen_id
 * @property int $xa_phuong_id
 * @property string $file_dinh_kem
 */
class RegChuTheToChuc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TT_ACTIVE = 1;
    const TT_NEWREG = 3;
    const TT_NOACTIVE = 2;
    const TT_ISDELETE = -1;

    const TRANG_THAI_ARRAY = array(
        RegChuTheToChuc::TT_ACTIVE => 'Đã duyệt',
        RegChuTheToChuc::TT_NEWREG =>'Đề nghị duyệt',
        RegChuTheToChuc::TT_NOACTIVE =>'Không duyệt',
        RegChuTheToChuc::TT_ISDELETE =>'Đánh dấu xóa',
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
        return 'reg_chu_the_to_chuc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_to_chuc','ma_so_thue','giay_dang_ky_kd','dia_chi_tru_so','nguoi_dai_dien','noi_cap','ngay_cap','tinh_thanh_id','quan_huyen_id','xa_phuong_id','loai_hinh_hoat_dong_id_array','file_dinh_kem'],'required'],
            [['ngay_cap', 'ngay_tao', 'ngay_duyet'], 'safe'],
            [['nguoi_duyet', 'trang_thai_id', 'tinh_thanh_id', 'quan_huyen_id', 'xa_phuong_id'], 'integer'],
            [['file_dinh_kem'], 'string'],
            [['ma', 'giay_dang_ky_kd', 'loai_hinh_hoat_dong_id', 'ma_so_thue', 'so_cmtnd', 'so_dien_thoai'], 'string', 'max' => 45],
            [['ten_to_chuc', 'ten_thuong_mai', 'ten_tieng_nuoc_ngoai', 'nguoi_dai_dien', 'noi_cap', 'website', 'email'], 'string', 'max' => 256],
            [['dia_chi_tru_so'], 'string', 'max' => 400],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'ma' => Yii::t('common', 'Mã'),
            'ten_to_chuc' => Yii::t('common', 'Tên tổ chức'),
            'ten_thuong_mai' => Yii::t('common', 'Tên thương mại'),
            'ten_tieng_nuoc_ngoai' => Yii::t('common', 'Tên nước ngoài'),
            'giay_dang_ky_kd' => Yii::t('common', 'Số đăng ký kinh doanh'),
            'loai_hinh_hoat_dong_id' => Yii::t('common', 'Loại hình hoạt động'),
            'ma_so_thue' => Yii::t('common', 'Mã số thuế'),
            'nguoi_dai_dien' => Yii::t('common', 'Người đại diện'),
            'so_cmtnd' => Yii::t('common', 'Số CMTND'),
            'ngay_cap' => Yii::t('common', 'Ngày cấp'),
            'noi_cap' => Yii::t('common', 'Nơi cấp'),
            'dia_chi_tru_so' => Yii::t('common', 'Địa chỉ trụ sở'),
            'website' => Yii::t('common', 'Website'),
            'email' => Yii::t('common', 'Email'),
            'so_dien_thoai' => Yii::t('common', 'Số điện thoại'),
            'ngay_tao' => Yii::t('common', 'Ngày tạo'),
            'nguoi_duyet' => Yii::t('common', 'Người duyệt'),
            'ngay_duyet' => Yii::t('common', 'Ngày duyệt'),
            'trang_thai_id' => Yii::t('common', 'Trạng thái'),
            'tinh_thanh_id' => Yii::t('common', 'Tỉnh thành'),
            'quan_huyen_id' => Yii::t('common', 'Quận huyện'),
            'xa_phuong_id' => Yii::t('common', 'Xã phường'),
            'file_dinh_kem' => Yii::t('common', 'Ảnh GDK Kinh doanh'),
            'loai_hinh_hoat_dong_id_array' => Yii::t('common', 'Loại hình hoạt động (*)'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\RegChuTheToChucQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\RegChuTheToChucQuery(get_called_class());
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
