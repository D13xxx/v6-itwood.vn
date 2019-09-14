<?php

namespace common\models\querys;

use common\models\SysKieuKhaiThac;

/**
 * This is the ActiveQuery class for [[\common\models\SysKieuKhaiThac]].
 *
 * @see \common\models\SysKieuKhaiThac
 */
class SysKieuKhaiThacQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\SysKieuKhaiThac[]|array
     */
    public function active()
    {
        return $this->andWhere(['trang_thai'=>SysKieuKhaiThac::TT_ACTIVE]);
    }

    public function noactive()
    {
        return $this->andWhere(['trang_thai'=>SysKieuKhaiThac::TT_NOACTIVE]);
    }

    public function isdelete()
    {
        return $this->andWhere(['trang_thai'=>SysKieuKhaiThac::TT_ISDELETE]);
    }
}
