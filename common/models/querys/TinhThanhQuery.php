<?php

namespace common\models\querys;

/**
 * This is the ActiveQuery class for [[\common\models\TinhThanh]].
 *
 * @see \common\models\TinhThanh
 */
class TinhThanhQuery extends \yii\db\ActiveQuery
{

    public function active()
    {
        return $this->andWhere('[[trang_thai]]=1');
    }

    public function isdelete()
    {
        return $this->andWhere('[[trang_thai]]=-1');
    }
    public function noactive()
    {
        return $this->andWhere('[[trang_thai]]=0');
    }
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\TinhThanh[]|array
     */

}
