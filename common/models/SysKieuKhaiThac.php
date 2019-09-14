<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sys_kieu_khai_thac".
 *
 * @property int $id
 * @property string $ten
 * @property int $trang_thai
 */
class SysKieuKhaiThac extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TT_ACTIVE = 1;
    const TT_NOACTIVE =0;
    const TT_ISDELETE = -1;

    public static function tableName()
    {
        return 'sys_kieu_khai_thac';
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
            'trang_thai' => Yii::t('common', 'Trạng thái'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\SysKieuKhaiThacQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\SysKieuKhaiThacQuery(get_called_class());
    }
}
