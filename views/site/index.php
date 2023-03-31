<?php

/** @var yii\web\View $this */

/** @var Products $products */

use app\models\Products;
use yii\bootstrap4\Carousel;

$this->title = 'Главная';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-site text-white">
        <?= \yii\bootstrap4\Html::img('imgs/logo.svg', ['width' => '100', 'alt' => 'logo']) ?>
        <h1 class="display-4"><?= \yii\bootstrap4\Html::encode($this->title) ?></h1>
        <p class="lead">Девиз компании!</p>
    </div>
</div>
