<?php

namespace common\models\querys;

use common\models\RegQuyenSuDungDat;

/**
 * This is the ActiveQuery class for [[\common\models\RegQuyenSuDungDat]].
 *
 * @see \common\models\RegQuyenSuDungDat
 */
class RegQuyenSuDungDatQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['trang_thai_id'=>RegQuyenSuDungDat::TT_ACTIVE]);
    }

    public function noactive()
    {
        return $this->andWhere(['trang_thai_id'=>RegQuyenSuDungDat::TT_NOACTIVE]);
    }

    public function isdelete()
    {
        return $this->andWhere(['trang_thai_id'=>RegQuyenSuDungDat::TT_ISDELETE]);
    }
}
