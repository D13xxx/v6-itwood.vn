<?php

namespace common\models\querys;

/**
 * This is the ActiveQuery class for [[\common\models\SysTrachNhiemTuanThu]].
 *
 * @see \common\models\SysTrachNhiemTuanThu
 */
class SysTrachNhiemTuanThuQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[trang_thai_id]]=1');
    }

    /**
     * {@inheritdoc}
     * @return \common\models\SysTrachNhiemTuanThu[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\SysTrachNhiemTuanThu|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
