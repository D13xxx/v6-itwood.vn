<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sys_chu_so_huu".
 *
 * @property int $id
 * @property string $ten
 * @property int $trang_thai_id
 * @property int $nguoi_tao
 * @property string $ngay_tao
 * @property int $nguoi_sua
 * @property string $ngay_sua
 */
class SysChuSoHuu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_chu_so_huu';
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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'ten' => Yii::t('common', 'Ten'),
            'trang_thai_id' => Yii::t('common', 'Trang Thai ID'),
            'nguoi_tao' => Yii::t('common', 'Nguoi Tao'),
            'ngay_tao' => Yii::t('common', 'Ngay Tao'),
            'nguoi_sua' => Yii::t('common', 'Nguoi Sua'),
            'ngay_sua' => Yii::t('common', 'Ngay Sua'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\SysChuSoHuuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\SysChuSoHuuQuery(get_called_class());
    }
}
