<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/1/2019
 * Time: 8:47 AM
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class TruyXuat extends ActiveRecord
{

    public function rules()
    {
        return [
            [['maTimKiem'], 'string', 'max' => 255],
        ];
    }

}