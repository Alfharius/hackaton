<?php

use yii\data\Sort;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $sort Sort */
/* @var $catalogError string */

$this->title = 'Catalog';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-catalog">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo $this->render('_search', ['model' => $searchModel]);
    echo $sort->link('name') . ' | ' . $sort->link('year') . ' | ' . $sort->link('price');
    $models = $dataProvider->query->all();
    ?>
    <div class="d-flex flex-wrap">
        <?php foreach ($models as $model): ?>
            <div class="wrapper col-12 col-md-6 col-lg-4">
                <div class="card m-1 my-2">
                    <a href="<?= Url::toRoute(['view', 'id' => $model->id]) ?>">
                        <img class="card-img-top" src="/uploads/<?= $model->img ?>" alt="img">
                    </a>
                    <div class="card-body">
                        <?php
                        $formId = 'product-add-' . $model->id;
                        Pjax::begin(); ?>
                        <div class="card-title">
                            <?= $model->name ?>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="font-weight-bolder">Price</div>
                            <div><?= $model->price ?></div>
                        </div>
                        <?php if (\app\models\Users::identity()):
                            echo Html::beginForm(['/products/add', 'id' => $model->id, 'from' => 'catalog'], 'post', [
                                    'id' => $formId,
                                    'class' => 'd-flex justify-content-end mt-2',
                                    'data-pjax' => 1,
                                ])
                                . Html::submitButton('Add to Cart', [
                                    'class' => 'btn btn-success'
                                ])
                                . Html::endForm();
                            if ($catalogError) {
                                echo '<div class="mt-2 text-danger text-center col-12">' . $catalogError . '</div>';
                            }
                        endif; ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
