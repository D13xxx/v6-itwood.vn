<?php

namespace common\models\querys;

/**
 * This is the ActiveQuery class for [[\common\models\RegHoSoGoKhongDuyet]].
 *
 * @see \common\models\RegHoSoGoKhongDuyet
 */
class RegHoSoGoKhongDuyetQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\RegHoSoGoKhongDuyet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\RegHoSoGoKhongDuyet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
