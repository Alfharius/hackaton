<?php

use app\models\Orders;
use app\models\OrdersProducts;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php
    if (\app\models\Users::isAdmin()){
        echo $this->render('_search', ['model' => $searchModel]);
    }
    /** @var Orders $orders */
    $orders = $dataProvider->query->all();
    $items = [];
    /** @var Orders $order */
    foreach ($orders as $order) {
        $count = 0;
        $order_products = $order->getOrdersProducts()->all();
        $contents = [];
        /** @var OrdersProducts $order_product */
        foreach ($order_products as $order_product) {
            $count += $order_product->count;
            $product = $order_product->product;
            $contents[] = '<div class="card m-md-2 m-1">' .
                '<div class="card-body">' .
                '<div class="card-title">' .
                $product->name .
                '</div>' .
                '<div class="d-flex justify-content-between">' .
                '<div class="font-weight-bolder">Price</div>' .
                '<div>' . $product->price . '</div>' .
                '</div>' .
                '<div class="d-flex justify-content-between">' .
                '<div class="font-weight-bolder">Count</div>' .
                '<div>' . $order_product->count . '</div>' .
                '</div>' .
                '</div >' .
                '</div >';
        }

        if ($order->status === 'Новый') {
            if (!\app\models\Users::isAdmin()) {
                $contents[] = Html::beginForm(['/orders/delete', 'id' => $order->id], 'post', ['class' => 'form-inline'])
                    . Html::submitButton(
                        'Delete',
                        ['class' => 'btn btn-outline-secondary logout']
                    )
                    . Html::endForm();
            }

            if (\app\models\Users::isAdmin()) {
                $id = 'note-' . $order->id;
                $contents[] = '<div class="d-flex justify-content-between">' .
                    Html::beginForm(['/orders/accept', 'id' => $order->id], 'post', ['class' => 'form-inline'])
                    . Html::submitButton(
                        'Accept',
                        ['class' => 'btn btn-outline-primary']
                    )
                    . Html::endForm() .
                    Html::beginForm(['/orders/cancel', 'id' => $order->id], 'post', ['class' => 'form-inline'])
                    . Html::label('Причина', $id)
                    . Html::textarea('note', '', ['class' => 'form-control mr-2 ml-1', 'id' => $id, 'required' => true])
                    . Html::submitButton(
                        'Cancel',
                        ['class' => 'btn btn-outline-danger']
                    )
                    . Html::endForm() .
                    '</div>';
            }
        }

        if ($order->status === 'Отменённый') {
            array_unshift($contents,
                'Причина отмены ' . $order->note
            );
        }

        $label = 'Заказ ' . $order->id . ' | ' . $order->status . ' | Всего товаров: ' . $count;
        if (\app\models\Users::isAdmin()) {
            $user = $order->user;
            $label = ' | ' . $user->name . ' ' . $user->surname . ' ' . $user->patronymic. ' | Всего товаров: '. $count . ' | ';
        }

        $item = [
            'label' => $label,
            'content' => $contents,
        ];
        $items[] = $item;
    }

    // echo $this->render('_search', ['model' => $searchModel]);
    echo \yii\bootstrap4\Accordion::widget([
        'items' => $items,
    ]);
    ?>
    <?php Pjax::end(); ?>

</div>
