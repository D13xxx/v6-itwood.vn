<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "banner".
 *
 * @property int $id
 * @property string $title
 * @property string $images
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const StatusActive =1;
    const StatusNoActive =0;

    public static function tableName()
    {
        return 'banner';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public static function StatusArray()
    {
        return [
            self::StatusActive=>'Hoạt động',
            self::StatusNoActive=>'Không hoạt động'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 400],
            [['images'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'title' => Yii::t('common', 'Title'),
            'images' => Yii::t('common', 'Images'),
            'status' => Yii::t('common', 'Status'),
            'created_by' => Yii::t('common', 'Create By'),
            'updated_by' => Yii::t('common', 'Update By'),
            'created_at' => Yii::t('common', 'Create At'),
            'updated_at' => Yii::t('common', 'Update At'),
        ];
    }

    public function getNguoiTao()
    {
        return $this->hasOne(User::className(),['id'=>'created_by']);
    }
    public function getNguoiCapNhat()
    {
        return $this->hasOne(User::className(),['id'=>'updated_by']);
    }
}
