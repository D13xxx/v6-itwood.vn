<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reg_quyen_su_dung_dat".
 *
 * @property int $id
 * @property int $quyen_su_dung_dat_id
 * @property string $so_van_ban
 * @property string $ngay_ban_hanh
 * @property string $so_vao_so
 * @property string $co_quan_ban_hanh
 * @property int $trang_thai_id
 * @property int $chu_the_id
 * @property int $loai_chu_the_id
 * @property int $ma
 * @property int $file_dinh_kem
 */
class RegQuyenSuDungDat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TT_ACTIVE =1;
    const TT_NOACTIVE =2;
    const TT_ISDELETE = -1;

    public static function TT_ARRAY()
    {
        return [
            self::TT_ACTIVE => Yii::t('frontend','Đang sử dụng'),
            self::TT_NOACTIVE => Yii::t('frontend','Không sử dụng'),
            self::TT_ISDELETE => Yii::t('frontend','Đánh dấu xóa')
        ];
    }

    public static function tableName()
    {
        return 'reg_quyen_su_dung_dat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quyen_su_dung_dat_id','file_dinh_kem'],'required'],
            [['quyen_su_dung_dat_id', 'trang_thai_id', 'chu_the_id', 'loai_chu_the_id'], 'integer'],
            [['ngay_ban_hanh'], 'safe'],
            [['so_van_ban', 'so_vao_so','ma'], 'string', 'max' => 50],
            [['co_quan_ban_hanh'], 'string', 'max' => 255],
            [['file_dinh_kem'], 'file','maxFiles'=>100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'quyen_su_dung_dat_id' => Yii::t('common', 'Loại quyền sử dụng đất'),
            'so_van_ban' => Yii::t('common', 'Số văn bản'),
            'ngay_ban_hanh' => Yii::t('common', 'Ngày ban hành'),
            'so_vao_so' => Yii::t('common', 'Số vào sổ'),
            'co_quan_ban_hanh' => Yii::t('common', 'Cơ quan ban hành'),
            'trang_thai_id' => Yii::t('common', 'Trạng thái'),
            'chu_the_id' => Yii::t('common', 'Chủ thể'),
            'loai_chu_the_id' => Yii::t('common', 'Loại chủ thể'),
            'ma' => Yii::t('common', 'Mã QSD Đất'),
            'file_dinh_kem' => Yii::t('common', 'Ảnh Giấy CNSD Đất'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\RegQuyenSuDungDatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\RegQuyenSuDungDatQuery(get_called_class());
    }

    public function getLoaiQuyenSuDungDat()
    {
        return $this->hasOne(SysQuyenSuDungDat::className(),['id'=>'quyen_su_dung_dat_id']);
    }

    public static function DemLoRung($idQSD)
    {
        $query = RegLoRung::find()->where(['quyen_sdd_id'=>$idQSD]);
        $count = $query->count();

        return $count;
    }
}
