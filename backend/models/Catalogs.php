<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/19/2018
 * Time: 9:59 AM
 */
namespace backend\models;
use Yii;
use creocoder\nestedsets\NestedSetsBehavior;
use yii\db\ActiveRecord;

class Catalogs extends \kartik\tree\models\Tree
{
    use \kartik\tree\models\TreeTrait {
        isDisabled as parentIsDisabled; // note the alias
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_catelogs';
    }

    /**
     * Note overriding isDisabled method is slightly different when
     * using the trait. It uses the alias.
     */
    public function isDisabled()
    {
        if (Yii::$app->user->identity->username !== 'admin') {
            return true;
        }
        return $this->parentIsDisabled();
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[]=['ma','safe'];
        return $rules;
    }

    public function attributeLabels()
    {
        return [
            'ma'=> Yii::t('backend','Mã phòng ban'),
            'name'=> Yii::t('backend','Tên phòng ban'),
        ];
    }
}