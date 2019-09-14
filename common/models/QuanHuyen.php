<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quan_huyen".
 *
 * @property int $id
 * @property string $ma
 * @property string $ten
 * @property int $tinh_thanh_id
 * @property int $trang_thai
 * @property int $is_delete
 * @property int $nguoi_xoa
 * @property string $ngay_xoa
 */
class QuanHuyen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const TT_ACTIVE = 1;
    const TT_NOACTIVE =0;
    const TT_ISDELETE = -1;

    public static function tableName()
    {
        return 'quan_huyen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma','ten','tinh_thanh_id'],'required'],
            [['tinh_thanh_id', 'trang_thai', 'is_delete', 'nguoi_xoa'], 'integer'],
            [['ngay_xoa'], 'safe'],
            [['ma'], 'string', 'max' => 10],
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
            'ma' => Yii::t('common', 'Mã'),
            'ten' => Yii::t('common', 'Tên'),
            'tinh_thanh_id' => Yii::t('common', 'Tỉnh thành'),
            'trang_thai' => Yii::t('common', 'Trạng thái'),
            'is_delete' => Yii::t('common', 'Đánh dấu xóa'),
            'nguoi_xoa' => Yii::t('common', 'Người xóa'),
            'ngay_xoa' => Yii::t('common', 'Ngày xóa'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\QuanHuyenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\QuanHuyenQuery(get_called_class());
    }

    public function getTinhThanh()
    {
        return $this->hasOne(TinhThanh::className(),['id'=>'tinh_thanh_id']);
    }
}
