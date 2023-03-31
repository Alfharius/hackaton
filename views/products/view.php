<?php

use app\models\Users;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
$isAdmin = Users::isAdmin();
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => [($isAdmin ? 'index' : 'catalog')]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if ($isAdmin): ?>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php
    endif;
    echo \yii\bootstrap4\Html::img('/uploads/' . $model->img, ['alt' => 'img', 'width' => '200px']);
    $attributes = [
        'name',
        'category' => [
            'label' => 'Category',
            'value' => function (\app\models\Products $model) {
                return \app\models\Categories::find()->where(['id' => $model->category])->select('name')->column()[0];
            }
        ],
        'year',
        'price',
        'count',
        'country',
        'model',
    ];
    if ($isAdmin) {
        array_unshift($attributes, 'id');
        $attributes[] = 'created_at';
    }
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
    ]);
    if (Users::identity()):?>
        <div onclick="cart.add(<?= $model->id ?>, <?= $model->count ?>)" class="btn btn-success">Add to cart</div>
    <?php endif; ?>
</div>
