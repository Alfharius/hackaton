<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders_products".
 *
 * @property int $id
 * @property int $product_id
 * @property int $order_id
 * @property int $count
 *
 * @property Orders $order
 * @property Products $product
 */
class OrdersProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'order_id', 'count'], 'required'],
            [['product_id', 'order_id', 'count'], 'integer'],
            [['product_id'], 'exist', 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'id']],
            [['order_id'], 'exist', 'targetClass' => Orders::class, 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'order_id' => 'Order ID',
            'count' => 'Count',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery|OrdersQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::class, ['id' => 'order_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery|ProductsQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::class, ['id' => 'product_id']);
    }

    /**
     * {@inheritdoc}
     * @return OrdersProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrdersProductsQuery(get_called_class());
    }
}
