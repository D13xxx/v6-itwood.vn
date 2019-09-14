<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sys_loai_hinh_hoat_dong".
 *
 * @property int $id
 * @property string $ten
 * @property int $trang_thai_id
 * @property int $is_del
 * @property int $nguoi_tao_id
 * @property string $ngay_tao
 * @property int $nguoi_sua_id
 * @property string $ngay_sua
 */
class SysLoaiHinhHoatDong extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TT_ACTIVE = 1;
    const TT_NOACTIVE = 0;
    const TT_ISDELETE = -1;



    public static function tableName()
    {
        return 'sys_loai_hinh_hoat_dong';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trang_thai_id', 'is_del', 'nguoi_tao_id', 'nguoi_sua_id'], 'integer'],
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
            'trang_thai_id' => Yii::t('common', 'Trạng thái'),
            'is_del' => Yii::t('common', 'Đánh dấu xóa'),
            'nguoi_tao_id' => Yii::t('common', 'Người tạo'),
            'ngay_tao' => Yii::t('common', 'Ngày tạo'),
            'nguoi_sua_id' => Yii::t('common', 'Người sửa'),
            'ngay_sua' => Yii::t('common', 'Ngày sửa'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\SysLoaiHinhHoatDongQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\SysLoaiHinhHoatDongQuery(get_called_class());
    }
}
