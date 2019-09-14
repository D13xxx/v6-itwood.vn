<?php

namespace common\models\querys;

use common\models\SysLoaiRung;

/**
 * This is the ActiveQuery class for [[\common\models\SysLoaiRung]].
 *
 * @see \common\models\SysLoaiRung
 */
class SysLoaiRungQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\SysLoaiRung[]|array
     */
    public function active()
    {
        return $this->andWhere(['trang_thai_id'=>SysLoaiRung::TT_ACTIVE]);
    }

    public function noactive()
    {
        return $this->andWhere(['trang_thai_id'=>SysLoaiRung::TT_NOACTIVE]);
    }

    public function isdelete()
    {
        return $this->andWhere(['trang_thai_id'=>SysLoaiRung::TT_ISDELETE]);
    }
}
