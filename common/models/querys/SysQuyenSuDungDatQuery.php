<?php

namespace common\models\querys;

use common\models\SysQuyenSuDungDat;

/**
 * This is the ActiveQuery class for [[\common\models\SysQuyenSuDungDat]].
 *
 * @see \common\models\SysQuyenSuDungDat
 */
class SysQuyenSuDungDatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\SysQuyenSuDungDat[]|array
     */
    public function active()
    {
        return $this->andWhere(['trang_thai_id'=>SysQuyenSuDungDat::TT_ACTIVE]);
    }

    public function noactive()
    {
        return $this->andWhere(['trang_thai_id'=>SysQuyenSuDungDat::TT_NOACTIVE]);
    }

    public function isdelete()
    {
        return $this->andWhere(['trang_thai_id'=>SysQuyenSuDungDat::TT_ISDELETE]);
    }
}
