<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reg_ho_so_go_khong_duyet".
 *
 * @property int $id
 * @property int $reg_ho_so_go_id
 * @property string $ly_do
 * @property int $nguoi_lap
 * @property string $ngay_lap
 */
class RegHoSoGoKhongDuyet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reg_ho_so_go_khong_duyet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_ho_so_go_id', 'nguoi_lap'], 'integer'],
            [['ly_do'], 'string'],
            [['ngay_lap'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'reg_ho_so_go_id' => Yii::t('common', 'Reg Ho So Go ID'),
            'ly_do' => Yii::t('common', 'Lý do'),
            'nguoi_lap' => Yii::t('common', 'Người lập'),
            'ngay_lap' => Yii::t('common', 'Ngày lập'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\RegHoSoGoKhongDuyetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\RegHoSoGoKhongDuyetQuery(get_called_class());
    }
}
