<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\web\UploadedFile;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property int $category
 * @property string $year
 * @property int $price
 * @property string|UploadedFile $img
 * @property int $count
 * @property string $country
 * @property string $model
 * @property string $created_at
 *
 * @property OrdersProducts[] $ordersProducts
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category', 'year', 'price', 'img', 'count', 'country', 'model'], 'required'],
            [['category', 'price', 'count'], 'integer'],
            [['name', 'country', 'model'], 'string', 'max' => 256],
            ['year', 'string', 'max' => 4],
            ['img', 'file', 'extensions' => ['png', 'jpg', 'gif', 'jpeg']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category' => 'Category',
            'year' => 'Year',
            'price' => 'Price',
            'img' => 'Img',
            'count' => 'Count',
            'country' => 'Country',
            'model' => 'Model',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @throws Exception
     */
    public function upload(): bool
    {
        $this->img = UploadedFile::getInstance($this, 'img');
        if ($this->validate()){
            $name = Yii::$app->security->generateRandomString(32) . '.' . $this->img->extension;
            if ($this->img->saveAs(Yii::$app->basePath.'/web/uploads/' . $name)){
                $this->img = $name;
                return true;
            }
        }
        return false;
    }

    /*    public function getOrdersProducts()
        {
            return $this->hasMany(OrdersProducts::class, ['product_id' => 'id']);
        }*/

    /**
     * {@inheritdoc}
     * @return ProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsQuery(get_called_class());
    }
}
