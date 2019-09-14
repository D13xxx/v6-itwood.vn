<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sys_trach_nhiem_tuan_thu".
 *
 * @property int $id
 * @property string $ten
 * @property int $loai_hinh_chu_the_id
 * @property int $nguoi_tao
 * @property string $ngay_tao
 * @property int $nguoi_sua
 * @property string $ngay_sua
 * @property string $trang_thai_id
 * @property string $loai_rung_id
 */
class SysTrachNhiemTuanThu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const TT_ACTIVE = 1;
    const TT_NOACTIVE =0;
    const TT_DELETE = -1;

    public static function tableName()
    {
        return 'sys_trach_nhiem_tuan_thu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loai_rung_id','ten','loai_hinh_chu_the_id'],'required'],
            [['loai_rung_id','loai_hinh_chu_the_id', 'nguoi_tao', 'nguoi_sua','trang_thai_id'], 'integer'],
            [['ngay_tao', 'ngay_sua'], 'safe'],
            [['ten'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'ten' => Yii::t('common', 'Tên'),
            'loai_hinh_chu_the_id' => Yii::t('common', 'Loại hình chủ thể'),
            'loai_rung_id' => Yii::t('common', 'Loại rừng'),
            'nguoi_tao' => Yii::t('common', 'Người tạo'),
            'ngay_tao' => Yii::t('common', 'Ngày tạo'),
            'nguoi_sua' => Yii::t('common', 'Người sửa'),
            'ngay_sua' => Yii::t('common', 'Ngày sửa'),
            'ngay_sua' => Yii::t('common', 'Trạng thái'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\SysTrachNhiemTuanThuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\SysTrachNhiemTuanThuQuery(get_called_class());
    }

    public function getLoaiRung()
    {
        return $this->hasOne(SysLoaiRung::className(),['id'=>'loai_rung_id']);
    }
}
