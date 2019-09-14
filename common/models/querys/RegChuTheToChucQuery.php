<?php

namespace common\models\querys;

use common\models\RegChuTheToChuc;

/**
 * This is the ActiveQuery class for [[\common\models\RegChuTheToChuc]].
 *
 * @see \common\models\RegChuTheToChuc
 */
class RegChuTheToChucQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['trang_thai_id'=>RegChuTheToChuc::TT_ACTIVE]);
    }

    public function noactive()
    {
        return $this->andWhere(['trang_thai_id'=>RegChuTheToChuc::TT_NOACTIVE]);
    }

    public function newreg()
    {
        return $this->andWhere(['trang_thai_id'=>RegChuTheToChuc::TT_NEWREG]);
    }

    public function isdisable()
    {
        return $this->andWhere(['trang_thai_id'=>RegChuTheToChuc::TT_ISDELETE]);
    }
}
