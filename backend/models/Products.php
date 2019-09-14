<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_products".
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property string $price
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'product_id'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'product_id' => Yii::t('backend', 'Product ID'),
            'name' => Yii::t('backend', 'Name'),
            'price' => Yii::t('backend', 'Price'),
        ];
    }
}
