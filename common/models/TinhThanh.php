<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tinh_thanh".
 *
 * @property int $id
 * @property string $ma
 * @property string $ten
 * @property int $trang_thai
 * @property int $is_delete
 * @property int $nguoi_xoa
 * @property string $ngay_xoa
 */
class TinhThanh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TT_ACTIVE = 1;
    const TT_NOACTIVE = 0;
    const TT_ISDELETE = -1;

    public static function tableName()
    {
        return 'tinh_thanh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma','ten'],'required'],
            [['trang_thai', 'is_delete', 'nguoi_xoa'], 'integer'],
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
            'trang_thai' => Yii::t('common', 'Trạng thái'),
            'is_delete' => Yii::t('common', 'Đánh dấu xóa'),
            'nguoi_xoa' => Yii::t('common', 'Người xóa'),
            'ngay_xoa' => Yii::t('common', 'Ngày xóa'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\TinhThanhQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\TinhThanhQuery(get_called_class());
    }
}
