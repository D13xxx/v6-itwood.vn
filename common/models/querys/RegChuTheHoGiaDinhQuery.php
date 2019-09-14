<?php

namespace common\models\querys;

use common\models\RegChuTheHoGiaDinh;

/**
 * This is the ActiveQuery class for [[\common\models\RegChuTheHoGiaDinh]].
 *
 * @see \common\models\RegChuTheHoGiaDinh
 */
class RegChuTheHoGiaDinhQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['trang_thai_id'=>RegChuTheHoGiaDinh::TT_ACTIVE]);
    }

    public function noactive()
    {
        return $this->andWhere(['trang_thai_id'=>RegChuTheHoGiaDinh::TT_NOACTIVE]);
    }

    public function newreg()
    {
        return $this->andWhere(['trang_thai_id'=>RegChuTheHoGiaDinh::TT_NEWREG]);
    }

    public function isdisable()
    {
        return $this->andWhere(['trang_thai_id'=>RegChuTheHoGiaDinh::TT_ISDELETE]);
    }

    public function denghiduyet()
    {
        return $this->andWhere(['trang_thai_id'=>RegChuTheHoGiaDinh::TT_DENGHIDUYET]);
    }
}
