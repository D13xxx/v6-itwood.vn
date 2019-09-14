<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sys_loai_cay".
 *
 * @property int $id
 * @property string $ma
 * @property string $ten
 * @property string $ten_khoa_hoc
 * @property int $nhom_cay_trong_id
 * @property int $tuoi_toi_thieu
 * @property int $trang_thai
 */
class SysLoaiCay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TT_ACTIVE = 1;
    const TT_NOACTIVE = 0;
    const TT_ISDELETE = -1;

    public static function tableName()
    {
        return 'sys_loai_cay';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nhom_cay_trong_id', 'tuoi_toi_thieu', 'trang_thai'], 'integer'],
            [['ma'], 'string', 'max' => 10],
            [['ten', 'ten_khoa_hoc'], 'string', 'max' => 256],
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
            'ten' => Yii::t('common', 'Tên phổ thông'),
            'ten_khoa_hoc' => Yii::t('common', 'Tên khoa học'),
            'nhom_cay_trong_id' => Yii::t('common', 'Nhóm cây'),
            'tuoi_toi_thieu' => Yii::t('common', 'Tuổi tối thiểu'),
            'trang_thai' => Yii::t('common', 'Trạng thái'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\SysLoaiCayQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\SysLoaiCayQuery(get_called_class());
    }
}
