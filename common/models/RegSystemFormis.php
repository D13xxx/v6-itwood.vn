<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reg_system_formis".
 *
 * @property int $id
 * @property string $url
 * @property string $bang_du_lieu
 * @property int $trang_thai_id
 * @property string $ngay_khoi_tao
 * @property int $nguoi_khoi_tao
 */
class RegSystemFormis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TT_HOAT_DONG = 1;
    const TT_KHONG_HOAT_DONG = 0;

    public static function tableName()
    {
        return 'reg_system_formis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url','bang_du_lieu'],'required'],
            [['trang_thai_id', 'nguoi_khoi_tao'], 'integer'],
            [['ngay_khoi_tao'], 'safe'],
            [['url', 'bang_du_lieu'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'url' => Yii::t('common', 'Url'),
            'bang_du_lieu' => Yii::t('common', 'Bảng dữ liệu'),
            'trang_thai_id' => Yii::t('common', 'Trạng thái'),
            'ngay_khoi_tao' => Yii::t('common', 'Ngày tạo'),
            'nguoi_khoi_tao' => Yii::t('common', 'Người tạo'),
        ];
    }
}
