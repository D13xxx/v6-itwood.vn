<?php

namespace common\models\querys;

/**
 * This is the ActiveQuery class for [[\common\models\RegHoSoGoGhepTemp]].
 *
 * @see \common\models\RegHoSoGoGhepTemp
 */
class RegHoSoGoGhepTempQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\RegHoSoGoGhepTemp[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\RegHoSoGoGhepTemp|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
