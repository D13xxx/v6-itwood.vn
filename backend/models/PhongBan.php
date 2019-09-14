<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/19/2018
 * Time: 9:39 AM
 */
namespace backend\models;

use kartik\tree\models\Tree;
use Yii;

class PhongBan extends Tree {

    public static $treeQueryClass;
    public $encodeNodeNames = true;
    public $purifyNodeIcons = true;
    public $nodeActivationErrors = [];
    public $nodeRemovalErrors = [];
    public $activeOrig = true;

    public static function tableName()
    {
        return 'phong_ban';
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['ten','loai_phong_ban_id'], 'safe'];
        return $rules;
    }
}