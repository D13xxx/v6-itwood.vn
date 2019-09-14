<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sys_kieu_trong_rung".
 *
 * @property int $id
 * @property string $ten
 * @property int $trang_thai
 */
class SysKieuTrongRung extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TT_ACTIVE =1;
    const TT_NOACTIVE = 2;
    const TT_ISDELETE =-1;

    public static function tableName()
    {
        return 'sys_kieu_trong_rung';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trang_thai'], 'integer'],
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
            'trang_thai' => Yii::t('common', 'Trang Thai'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\SysKieuTrongRungQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\SysKieuTrongRungQuery(get_called_class());
    }
}
