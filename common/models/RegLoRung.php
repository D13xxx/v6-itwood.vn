<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reg_lo_rung".
 *
 * @property int $id
 * @property string $tieu_khu
 * @property string $khoanh
 * @property string $lo
 * @property string $dia_chi
 * @property int $tinh_thanh_id
 * @property int $quan_huyen_id
 * @property int $xa_phuong_id
 * @property int $loai_rung_id
 * @property int $trang_thai_id
 * @property string $ma
 * @property int $nguoi_tao_id
 * @property string $ngay_tao
 * @property int $nguoi_sua_id
 * @property string $ngay_sua
 * @property int $nguoi_duyet_id
 * @property string $ngay_duyet
 * @property int $quyen_sdd_id
 * @property int $chu_the_id
 * @property int $khong_co_dinh_danh
 * @property int $dien_tich
 * @property string $so_thua_dat
 * @property string $to_ban_do_so
 * @property int $ngoai_ba_loai_rung
 */
class RegLoRung extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TT_RUNGMOIKHAIBAO =0;
    const TT_RUNGDENGHIDUYET =1;
    const TT_RUNGDUOCDUYET =2;
    const TT_RUNGKHONGDUOCDUYET =3;
    const TT_RUNGPHUCTRA = 4;

    public static function TT_ARRAY()
    {
        return [
            self::TT_RUNGMOIKHAIBAO => Yii::t('frontend','Mới tạo'),
            self::TT_RUNGDENGHIDUYET => Yii::t('frontend','Đề nghị duyệt'),
            self::TT_RUNGDUOCDUYET => Yii::t('frontend','Đã phê duyệt'),
            self::TT_RUNGKHONGDUOCDUYET => Yii::t('frontend','Không được duyệt'),
            self::TT_RUNGPHUCTRA => Yii::t('frontend','Rừng đang phúc tra')
        ];
    }

    public static function tableName()
    {
        return 'reg_lo_rung';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tieu_khu', 'khoanh', 'lo'],'required','on'=>'duyetPhucTra'],
            [['so_thua_dat','to_ban_do_so'],'required','on'=>'duyetPhucTraNgoaiBaLoaiRung'],
            [['khong_co_dinh_danh','loai_rung_id', 'trang_thai_id', 'nguoi_tao_id', 'nguoi_sua_id', 'nguoi_duyet_id', 'quyen_sdd_id', 'chu_the_id'], 'integer'],
            [['ngay_tao', 'ngay_sua', 'ngay_duyet'], 'safe'],
            [['tieu_khu', 'khoanh', 'lo', 'ma'], 'string', 'max' => 50],
            [['dia_chi'], 'string', 'max' => 255],
            [['so_thua_dat','to_ban_do_so'], 'string', 'max' => 20],
            [['dien_tich'], 'number'],
            [['tinh_thanh_id','quan_huyen_id','xa_phuong_id','ngoai_ba_loai_rung','loai_hinh_chu_the'],'integer']
        ];
    }

    public function validateDiaDanh($attribute,$param)
    {
        if($this->$attribute==''||$this->$attribute==null){
            $this->addError($attribute,Yii::t('frontend','"{attribute}" không được để trống'));
            return false;
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'tieu_khu' => Yii::t('common', 'Tiểu khu'),
            'khoanh' => Yii::t('common', 'Khoảnh'),
            'lo' => Yii::t('common', 'Lô'),
            'dia_chi' => Yii::t('common', 'Địa chỉ lô rừng'),
            'tinh_thanh_id' => Yii::t('common', 'Tỉnh thành'),
            'quan_huyen_id' => Yii::t('common', 'Quận huyện'),
            'xa_phuong_id' => Yii::t('common', 'Xã phường'),
            'loai_rung_id' => Yii::t('common', 'Loại rừng'),
            'trang_thai_id' => Yii::t('common', 'Trạng thái'),
            'ma' => Yii::t('common', 'Mã'),
            'nguoi_tao_id' => Yii::t('common', 'Người tạo'),
            'ngay_tao' => Yii::t('common', 'Ngày tạo'),
            'nguoi_sua_id' => Yii::t('common', 'Người sửa'),
            'ngay_sua' => Yii::t('common', 'Ngày sửa'),
            'nguoi_duyet_id' => Yii::t('common', 'Người duyệt'),
            'ngay_duyet' => Yii::t('common', 'Ngày duyệt'),
            'quyen_sdd_id' => Yii::t('common', 'Quyền sử dụng đất'),
            'chu_the_id' => Yii::t('common', 'Chủ thể'),
            'khong_co_dinh_danh' => Yii::t('common', 'Không có Tiểu khu - Khoảnh - Lô'),
            'dien_tich' => Yii::t('common', 'Diện tích (ha)'),
            'so_thua_dat' => Yii::t('common', 'Số thửa đất'),
            'to_ban_do_so' => Yii::t('common', 'Tờ bản đồ số'),
            'ngoai_ba_loai_rung' => Yii::t('common', 'Ngoài ba loại rừng'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\RegLoRungQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\RegLoRungQuery(get_called_class());
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

    public function getQuyenSuDungDat()
    {
        return $this->hasOne(RegQuyenSuDungDat::className(),['id'=>'quyen_sdd_id']);
    }

    public function getLoaiRung()
    {
        return $this->hasOne(SysLoaiRung::className(),['id'=>'loai_rung_id']);
    }

    public static function CountLoRungPhucTra($idLoRung)
    {
        $query = RegLoRungPhucTra::find()->where(['reg_lo_rung_id'=>$idLoRung])->all();
        if($query){
            $ketQua = count($query);
        } else {
            $ketQua = 0;
        }
//        $ketQua = count($query);
        return $query;
    }

}
