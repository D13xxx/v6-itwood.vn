<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sys_loai_rung".
 *
 * @property int $id
 * @property string $ten
 * @property int $trang_thai_id
 * @property int $nguoi_tao
 * @property string $ngay_tao
 * @property int $nguoi_sua
 * @property string $ngay_sua
 * @property string $ma
 */
class SysLoaiRung extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TT_ACTIVE = 1;
    const TT_NOACTIVE = 0;
    const TT_ISDELETE = -1;

    public static function tableName()
    {
        return 'sys_loai_rung';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trang_thai_id', 'nguoi_tao', 'nguoi_sua'], 'integer'],
            [['ngay_tao', 'ngay_sua'], 'safe'],
            [['ten'], 'string', 'max' => 255],
            [['ma'], 'string', 'max' => 10],
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
            'nguoi_tao' => Yii::t('common', 'Người tạo'),
            'ngay_tao' => Yii::t('common', 'Ngày tạo'),
            'nguoi_sua' => Yii::t('common', 'Người sửa'),
            'ngay_sua' => Yii::t('common', 'Ngày sửa'),
            'ma' => Yii::t('common', 'Mã rừng'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\SysLoaiRungQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\SysLoaiRungQuery(get_called_class());
    }
}
