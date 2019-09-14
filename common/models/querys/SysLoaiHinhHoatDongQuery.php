<?php

namespace common\models\querys;

use common\models\SysLoaiHinhHoatDong;

/**
 * This is the ActiveQuery class for [[\common\models\SysLoaiHinhHoatDong]].
 *
 * @see \common\models\SysLoaiHinhHoatDong
 */
class SysLoaiHinhHoatDongQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\SysLoaiHinhHoatDong[]|array
     */
    public function active()
    {
        return $this->andWhere(['trang_thai_id'=>SysLoaiHinhHoatDong::TT_ACTIVE]);
    }

    public function noactive()
    {
        return $this->andWhere(['trang_thai_id'=>SysLoaiHinhHoatDong::TT_NOACTIVE]);
    }

    public function isdelete()
    {
        return $this->andWhere(['trang_thai_id'=>SysLoaiHinhHoatDong::TT_ISDELETE]);
    }
}
