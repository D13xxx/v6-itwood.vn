<?php

namespace common\models\querys;

/**
 * This is the ActiveQuery class for [[\common\models\QuanHuyen]].
 *
 * @see \common\models\QuanHuyen
 */
class QuanHuyenQuery extends \yii\db\ActiveQuery
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


}
