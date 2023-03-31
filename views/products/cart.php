<?php

use app\models\Products;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $models Products */
$this->title = 'Cart';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-catalog">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if (!empty($models)) {
        Pjax::begin([
                'options' =>
                    ['class' => 'd-flex justify-content-end']]
        );
        echo Html::beginForm(['/orders/create'], 'post', ['class' => 'form-inline'])
            . Html::label('Пароль', 'password', ['class' => 'mr-1'])
            . Html::input('password', 'password', '', ['required' => true, 'id' => 'password', 'class' => 'form-control mr-2'])
            . Html::submitButton(
                'Сформировать заказ',
                ['class' => 'btn btn-primary']
            )
            . Html::endForm();
        Pjax::end();
    } else {
        echo '<div class="w-100 text-center lead">В корзине пока нет товаров</div>';
    } ?>
    <div class="d-flex flex-wrap">
        <?php
        if (!empty($models)) {
            $cart = Yii::$app->session->get('cart', []);
            foreach ($models as $model): ?>
                <div class="wrapper col-12 col-md-6 col-lg-4">
                    <div class="card m-md-2 m-1">
                        <a href="<?= Url::toRoute(['/products/view', 'id' => $model->id]) ?>">
                            <img class="card-img-top" src="/uploads/<?= $model->img ?>" alt="img">
                        </a>
                        <?php
                        Pjax::begin([
                            'options' => [
                                'class' => 'card-body'
                            ]
                        ]); ?>
                        <div class="card-title">
                            <?= $model->name ?>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="font-weight-bolder">Price</div>
                            <div><?= $model->price ?></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="font-weight-bolder">Count</div>
                            <div id="count-<?= $model->id ?>"><?= $cart['p.' . $model->id] ?></div>
                        </div>
                        <div>
                            <div class="d-flex flex-wrap justify-content-end mt-2">
                                <?php
                                echo Html::beginForm(['/products/remove', 'id' => $model->id], 'post', [
                                        'class' => 'col-6',
                                        'data-pjax' => 1,
                                    ])
                                    . Html::submitButton('Remove 1', [
                                        'class' => 'btn btn-outline-danger mr-2'
                                    ])
                                    . Html::endForm();
                                echo Html::beginForm(['/products/add', 'id' => $model->id, 'from' => 'cart'], 'post', [
                                        'class' => 'col-6',
                                        'data-pjax' => 1,
                                    ])
                                    . Html::submitButton('Add 1 more', [
                                        'class' => 'btn btn-success'
                                    ])
                                    . Html::endForm();
                                ?>
                            </div>
                            <?php
                            /** @var string $cartError */
                            if ($cartError) {
                                echo '<div class="mt-2 text-danger text-center col-12">' . $cartError . '</div>';
                            }
                            ?>
                        </div>
                        <div class="d-none"><?php var_dump(Yii::$app->session->get('cart', [])); ?></div>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            <?php endforeach;
        } ?>
    </div>
</div>
