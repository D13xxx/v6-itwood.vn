<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reg_ho_so_go".
 *
 * @property int $id
 * @property string $ma
 * @property int $reg_chu_the_id
 * @property string $ngay_lap
 * @property int $trang_thai_id
 * @property int $nguoi_duyet
 * @property string $ngay_duyet
 * @property int $giao_dich
 * @property int $loai_hinh_chu_the
 */
class RegHoSoGo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TT_HSG_MOI =1;
    const TT_HSG_DENGHIDUYET = 2;
    const TT_HSG_DUOCDUYET =3;
    const TT_HSG_KHONGDUYET =4;
    const TT_HSG_CHUYENDOI = -1;

    const TT_GIAODICH_YES =1;

    public static function TT_HSG_ARRAY(){
        return [
            self::TT_HSG_MOI=>Yii::t('common','Hồ sơ mới'),
            self::TT_HSG_DENGHIDUYET => Yii::t('common','Đề nghị xét duyệt'),
            self::TT_HSG_DUOCDUYET => Yii::t('common','Hồ sơ đã duyệt'),
            self::TT_HSG_KHONGDUYET => Yii::t('common','Hồ sơ không được duyệt'),
            self::TT_HSG_CHUYENDOI=>Yii::t('common','Hồ sơ đã chuyển đổi')
        ];
    }

    public static function TT_HSG_ARRAY_NEW(){
        return [
            self::TT_HSG_MOI=>Yii::t('common','Hồ sơ mới'),
            self::TT_HSG_DENGHIDUYET => Yii::t('common','Hồ sơ đề nghị duyệt'),
            self::TT_HSG_KHONGDUYET => Yii::t('common','Hồ sơ không được duyệt')
        ];
    }

    public static function TT_HSG_LABEL()
    {
        return [
            self::TT_HSG_MOI=>'<span class="label label-info">'.Yii::t('common','Hồ sơ mới').'</span>',
            self::TT_HSG_DENGHIDUYET => '<span class="label label-success">'.Yii::t('common','Đề nghị xét duyệt').'</span>',
            self::TT_HSG_DUOCDUYET => '<span class="label label-primary">'.Yii::t('common','Hồ sơ đã duyệt').'</span>',
            self::TT_HSG_KHONGDUYET => '<span class="label label-danger">'.Yii::t('common','Hồ sơ không được duyệt').'</span>',
            self::TT_HSG_CHUYENDOI=>'<span class="label label-default">'.Yii::t('common','Hồ sơ đã chuyển đổi').'</span>'
        ];
    }


    public static function tableName()
    {
        return 'reg_ho_so_go';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_chu_the_id', 'trang_thai_id', 'nguoi_duyet','tinh_thanh_id','quan_huyen_id','xa_phuong_id','ho_so_goc'], 'integer'],
            [['ngay_lap', 'ngay_duyet'], 'safe'],
            [['ma'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'ma' => Yii::t('common', 'Mã hồ sơ'),
            'reg_chu_the_id' => Yii::t('common', 'Chủ thể'),
            'ngay_lap' => Yii::t('common', 'Ngày lập'),
            'trang_thai_id' => Yii::t('common', 'Trạng thái'),
            'nguoi_duyet' => Yii::t('common', 'Người duyệt'),
            'ngay_duyet' => Yii::t('common', 'Ngày duyệt'),
            'giao_dich' => Yii::t('common', 'Giao dịch'),
            'reg_loai_hinh_chu_the' => Yii::t('common', 'Loại hình chủ thể'),
            'tinh_thanh_id' => Yii::t('common', 'Tỉnh thành'),
            'quan_huyen_id' => Yii::t('common', 'Quận huyện'),
            'xa_phuong_id' => Yii::t('common', 'Xã phường'),
            'ho_so_goc' => Yii::t('common', 'Hồ sơ gốc'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\RegHoSoGoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\RegHoSoGoQuery(get_called_class());
    }

    public function getChuThe()
    {
        return $this->hasOne(User::className(),['id'=>'reg_chu_the_id']);
    }

    public static function TongKhoiLuongLoGo($idHoSoGo)
    {
        $query = RegHoSoGoChiTiet::find()->where(['reg_ho_so_go_id'=>$idHoSoGo]);
        $tongKhoiLuong = $query->sum('(khoi_luong-khoi_luong_da_dung)');
        return $tongKhoiLuong;
    }

    public function getNguoiDuyet()
    {
        return $this->hasOne(User::className(),['id'=>'nguoi_duyet']);
    }
}
