<?php

namespace common\models\querys;

/**
 * This is the ActiveQuery class for [[\common\models\RegHoSoXinKhaiThacGiaoDich]].
 *
 * @see \common\models\RegHoSoXinKhaiThacGiaoDich
 */
class RegHoSoXinKhaiThacGiaoDichQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\RegHoSoXinKhaiThacGiaoDich[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\RegHoSoXinKhaiThacGiaoDich|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
