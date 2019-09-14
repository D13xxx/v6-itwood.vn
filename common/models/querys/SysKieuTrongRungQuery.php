<?php

namespace common\models\querys;

use common\models\SysKieuTrongRung;

/**
 * This is the ActiveQuery class for [[\common\models\SysKieuTrongRung]].
 *
 * @see \common\models\SysKieuTrongRung
 */
class SysKieuTrongRungQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\SysKieuTrongRung[]|array
     */

    public function active()
    {
        return $this->andWhere(['trang_thai'=>SysKieuTrongRung::TT_ACTIVE]);
    }
    public function noactive()
    {
        return $this->andWhere(['trang_thai'=>SysKieuTrongRung::TT_NOACTIVE]);
    }
    public function isdelete()
    {
        return $this->andWhere(['trang_thai'=>SysKieuTrongRung::TT_ISDELETE]);
    }
}
