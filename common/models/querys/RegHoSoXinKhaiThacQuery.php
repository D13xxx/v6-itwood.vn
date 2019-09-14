<?php

namespace common\models\querys;

/**
 * This is the ActiveQuery class for [[\common\models\RegHoSoXinKhaiThac]].
 *
 * @see \common\models\RegHoSoXinKhaiThac
 */
class RegHoSoXinKhaiThacQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\RegHoSoXinKhaiThac[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\RegHoSoXinKhaiThac|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
