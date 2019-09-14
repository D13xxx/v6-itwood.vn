<?php

namespace common\models\querys;

use common\models\RegHoSoGo;

/**
 * This is the ActiveQuery class for [[\common\models\RegHoSoGo]].
 *
 * @see \common\models\RegHoSoGo
 */
class RegHoSoGoQuery extends \yii\db\ActiveQuery
{
    public function hosomoi()
    {
        return $this->andWhere(['trang_thai_id'=>RegHoSoGo::TT_HSG_MOI]);
    }
    public function denghiduyet()
    {
        return $this->andWhere(['trang_thai_id'=>RegHoSoGo::TT_HSG_DENGHIDUYET]);
    }
    public function hosoduocduyet()
    {
        return $this->andWhere(['trang_thai_id'=>RegHoSoGo::TT_HSG_DUOCDUYET]);
    }
    public function hosokhongduyet()
    {
        return $this->andWhere(['trang_thai_id'=>RegHoSoGo::TT_HSG_KHONGDUYET]);
    }
    public function hosochuyendoi()
    {
        return $this->andWhere(['trang_thai_id'=>RegHoSoGo::TT_HSG_CHUYENDOI]);
    }
}
