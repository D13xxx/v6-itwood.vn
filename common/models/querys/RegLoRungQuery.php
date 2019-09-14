<?php

namespace common\models\querys;

use common\models\RegLoRung;

/**
 * This is the ActiveQuery class for [[\common\models\RegLoRung]].
 *
 * @see \common\models\RegLoRung
 */
class RegLoRungQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\RegLoRung[]|array
     */
    public function daduyet()
    {
        return $this->andWhere(['trang_thai_id'=>RegLoRung::TT_RUNGDUOCDUYET]);
    }

    public function khongduyet()
    {
        return $this->andWhere(['trang_thai_id'=>RegLoRung::TT_RUNGKHONGDUOCDUYET]);
    }

    public function dangkymoi()
    {
        return $this->andWhere(['trang_thai_id'=>RegLoRung::TT_RUNGMOIKHAIBAO]);
    }

    public function denghiduyet()
    {
        return $this->andWhere(['trang_thai_id'=>RegLoRung::TT_RUNGDUOCDUYET]);
    }
}
