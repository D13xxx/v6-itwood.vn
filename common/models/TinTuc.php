<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tin_tuc".
 *
 * @property int $id
 * @property string $tieu_de
 * @property string $tom_tat
 * @property string $chi_tiet
 * @property string $anh_dai_dien
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $tin_noi_bat
 * @property int $so_lan_xem
 */
class TinTuc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tin_tuc';
    }

    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules()
    {
        return [
            [['chi_tiet'], 'string'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by','tin_noi_bat','so_lan_xem'], 'integer'],
            [['tieu_de'], 'string', 'max' => 400],
            [['tom_tat'], 'string', 'max' => 800],
            [['anh_dai_dien'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'tieu_de' => Yii::t('common', 'Tiêu đề'),
            'tom_tat' => Yii::t('common', 'Nội dung tóm tắt'),
            'chi_tiet' => Yii::t('common', 'Nội dung chi tiết'),
            'anh_dai_dien' => Yii::t('common', 'Ảnh đại diện'),
            'status' => Yii::t('common', 'Trạng thái'),
            'created_at' => Yii::t('common', 'Ngày tạo'),
            'updated_at' => Yii::t('common', 'Ngày cập nhật'),
            'created_by' => Yii::t('common', 'Tạo bởi'),
            'updated_by' => Yii::t('common', 'Sửa bởi'),
            'tin_noi_bat' => Yii::t('common', 'Tin nổi bật'),
            'so_lan_xem' => Yii::t('common', 'Số lần xem'),
        ];
    }

    public function getNguoiTao()
    {
        return $this->hasOne(User::className(),['id'=>'created_by']);
    }

    public function getNguoiCapNhat()
    {
        return $this->hasOne(User::className(),['id'=>'updated_by']);
    }
}
