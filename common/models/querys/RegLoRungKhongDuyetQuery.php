<?php

namespace common\models\querys;

/**
 * This is the ActiveQuery class for [[\common\models\RegLoRungKhongDuyet]].
 *
 * @see \common\models\RegLoRungKhongDuyet
 */
class RegLoRungKhongDuyetQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\RegLoRungKhongDuyet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\RegLoRungKhongDuyet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
