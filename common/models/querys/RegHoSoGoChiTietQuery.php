<?php

namespace common\models\querys;

/**
 * This is the ActiveQuery class for [[\common\models\RegHoSoGoChiTiet]].
 *
 * @see \common\models\RegHoSoGoChiTiet
 */
class RegHoSoGoChiTietQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\RegHoSoGoChiTiet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\RegHoSoGoChiTiet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
