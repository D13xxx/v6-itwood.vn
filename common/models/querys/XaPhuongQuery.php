<?php

namespace common\models\querys;

use common\models\XaPhuong;

/**
 * This is the ActiveQuery class for [[\common\models\XaPhuong]].
 *
 * @see \common\models\XaPhuong
 */
class XaPhuongQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['trang_thai'=>XaPhuong::TT_ACTIVE]);
    }

    public function noactive()
    {
        return $this->andWhere(['trang_thai'=>XaPhuong::TT_NOACTIVE]);
    }

    public function isdelete()
    {
        return $this->andWhere(['trang_thai'=>XaPhuong::TT_ISDELETE]);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\XaPhuong[]|array
     */

}
