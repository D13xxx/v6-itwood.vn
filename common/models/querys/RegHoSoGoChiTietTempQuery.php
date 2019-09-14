<?php

namespace common\models\querys;

/**
 * This is the ActiveQuery class for [[\common\models\RegHoSoGoChiTietTemp]].
 *
 * @see \common\models\RegHoSoGoChiTietTemp
 */
class RegHoSoGoChiTietTempQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\RegHoSoGoChiTietTemp[]|array
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
