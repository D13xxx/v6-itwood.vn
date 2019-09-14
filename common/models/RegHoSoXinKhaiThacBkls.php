<?php

namespace common\models;

use common\models\searchs\RegHoSoXinKhaiThacBklsSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

/**
 * This is the model class for table "reg_ho_so_xin_khai_thac_bkls".
 *
 * @property int $id
 * @property int $reg_lo_rung_id
 * @property double $dien_tich_khai_thac
 * @property int $phuong_thuc_khai_thac_id
 * @property double $tuoi_rung_khai_thac
 * @property int $so_cay_hien_tai
 * @property string $d13_cay_pho_bien
 * @property double $san_luong_du_kien
 * @property string $phuong_an_bao_ve_rung
 * @property int $trang_thai_id
 * @property int $reg_ho_so_xin_khai_thac_id
 * @property int $loai_cay_trong_id
 * @property int $phuong_thuc_trong_id
 * @property int $nam_trong
 * @property int $loai_von_dau_tu_id
 * @property string $chu_so_huu
 * @property string $khoi_luong_da_dung
 */
class RegHoSoXinKhaiThacBkls extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TT_BKLS_MOI =1;
    const TT_BKLS_DENGHIDUYET = 2;
    const TT_BKLS_DUOCDUYET = 3;
    const TT_BKLS_KHONGDUOCDUYET = 4;
    const TT_BKLS_ISDELETE = -1;
    const TT_BKLS_DASUDUNGHET = 5;

    public static function tableName()
    {
        return 'reg_ho_so_xin_khai_thac_bkls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_lo_rung_id','phuong_thuc_khai_thac_id','loai_cay_trong_id','dien_tich_khai_thac','san_luong_du_kien','tuoi_rung_khai_thac'],'required'],
            [['reg_lo_rung_id', 'phuong_thuc_khai_thac_id', 'so_cay_hien_tai', 'trang_thai_id', 'reg_ho_so_xin_khai_thac_id', 'loai_cay_trong_id', 'phuong_thuc_trong_id', 'nam_trong', 'loai_von_dau_tu_id'], 'integer'],
            [['dien_tich_khai_thac', 'tuoi_rung_khai_thac', 'san_luong_du_kien','khoi_luong_da_dung'], 'number'],
            [['d13_cay_pho_bien', 'phuong_an_bao_ve_rung'], 'string', 'max' => 50],
            [['chu_so_huu'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'reg_lo_rung_id' => Yii::t('common', 'Lô rừng trồng'),
            'dien_tich_khai_thac' => Yii::t('common', 'Diện tích khai thác (ha)'),
            'phuong_thuc_khai_thac_id' => Yii::t('common', 'Phương thức khai thác'),
            'tuoi_rung_khai_thac' => Yii::t('common', 'Tuổi rừng khai thác (năm)'),
            'so_cay_hien_tai' => Yii::t('common', 'Số cây hiện tại'),
            'd13_cay_pho_bien' => Yii::t('common', 'D13 Cây phổ biến (cm)'),
            'san_luong_du_kien' => Yii::t('common', 'Sản lượng dự kiến (m3)'),
            'phuong_an_bao_ve_rung' => Yii::t('common', 'Chứng chỉ rừng'),
            'trang_thai_id' => Yii::t('common', 'Trạng thái'),
            'reg_ho_so_xin_khai_thac_id' => Yii::t('common', 'Reg Ho So Xin Khai Thac ID'),
            'loai_cay_trong_id' => Yii::t('common', 'Loài cây trồng'),
            'phuong_thuc_trong_id' => Yii::t('common', 'Phương thức trồng'),
            'nam_trong' => Yii::t('common', 'Năm trồng'),
            'loai_von_dau_tu_id' => Yii::t('common', 'Loại vốn đầu tư'),
            'chu_so_huu' => Yii::t('common', 'Chủ sở hữu'),
            'khoi_luong_da_dung' => Yii::t('common', 'Khối lượng đã dùng'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\RegHoSoXinKhaiThacBklsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\RegHoSoXinKhaiThacBklsQuery(get_called_class());
    }

    public function getLoaiVonDauTu()
    {
        return $this->hasOne(SysLoaiVonDauTu::className(),['id'=>'loai_von_dau_tu_id']);
    }

    public function getPhuongThucTrong()
    {
        return $this->hasOne(SysKieuTrongRung::className(),['id'=>'phuong_thuc_trong_id']);
    }

    public function getLoaiCayTrong()
    {
        return $this->hasOne(SysLoaiCay::className(),['id'=>'loai_cay_trong_id']);
    }

    public function getPhuongThucKhaiThac()
    {
        return $this->hasOne(SysKieuKhaiThac::className(),['id'=>'phuong_thuc_khai_thac_id']);
    }

    public function getHoSoXinKhaiThac()
    {
        return $this->hasOne(RegHoSoXinKhaiThac::className(),['id'=>'reg_ho_so_xin_khai_thac_id']);
    }

    public function getLoRung()
    {
        return $this->hasOne(RegLoRung::className(),['id'=>'reg_lo_rung_id']);
    }

    public static function ThongTinLoRung($idLoRung)
    {
        $model = RegLoRung::find()->where(['id'=>$idLoRung])->one();
        return $model;
    }
    public static function ThongTinLoaiCay($idLoaiCay)
    {
        $model = SysLoaiCay::find()->where(['id'=>$idLoaiCay])->one();
        return $model;
    }
    public static function PhuongThucTrong($idPhuongThucTrong)
    {
        return SysKieuTrongRung::find()->where(['id'=>$idPhuongThucTrong])->one();
    }

    public static function PhuongThucKhaiThac($idPhuongThucKT)
    {
        return SysKieuKhaiThac::find()->where(['id'=>$idPhuongThucKT])->one();
    }

    public static function LoaiVonDauTu($idLoaiVonDauTu)
    {
        return SysLoaiVonDauTu::find()->where(['id'=>$idLoaiVonDauTu])->one();
    }

    public static function TongDienTichKhaiThac($idHoSoKhaiThac)
    {
        $model = RegHoSoXinKhaiThacBkls::find()->where(['reg_ho_so_xin_khai_thac_id'=>$idHoSoKhaiThac]);
        $tongDienTich = $model->sum('dien_tich_khai_thac');
        return $tongDienTich;
    }

    public static function LichSuKhaiThac($idHoSoKhaiThac,$idLoRung)
    {
        $query = RegHoSoXinKhaiThacBkls::find()->where(['<>','reg_ho_so_xin_khai_thac_id',$idHoSoKhaiThac]);
        $query->andWhere(['reg_lo_rung_id'=>$idLoRung]);
        $query->andWhere(['or',['trang_thai_id'=>RegHoSoXinKhaiThacBkls::TT_BKLS_DUOCDUYET],['trang_thai_id'=>RegHoSoXinKhaiThacBkls::TT_BKLS_DASUDUNGHET]]);

        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination'=>['pageSize' => 20,]
        ]);

        return $dataProvider;
    }
}
