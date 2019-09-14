<?php

namespace common\models\querys;

/**
 * This is the ActiveQuery class for [[\common\models\RegHoSoXnKhaiThacKhongDuyet]].
 *
 * @see \common\models\RegHoSoXnKhaiThacKhongDuyet
 */
class RegHoSoXnKhaiThacKhongDuyetQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\RegHoSoXnKhaiThacKhongDuyet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\RegHoSoXnKhaiThacKhongDuyet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
