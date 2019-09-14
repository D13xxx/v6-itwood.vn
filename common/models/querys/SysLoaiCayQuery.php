<?php

namespace common\models\querys;

use common\models\SysLoaiCay;

/**
 * This is the ActiveQuery class for [[\common\models\SysLoaiCay]].
 *
 * @see \common\models\SysLoaiCay
 */
class SysLoaiCayQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\SysLoaiCay[]|array
     */
    public function active()
    {
        return $this->andWhere(['trang_thai'=>SysLoaiCay::TT_ACTIVE]);
    }
    public function noactive()
    {
        return $this->andWhere(['trang_thai'=>SysLoaiCay::TT_NOACTIVE]);
    }
    public function isdelete()
    {
        return $this->andWhere(['trang_thai'=>SysLoaiCay::TT_ISDELETE]);
    }
}
