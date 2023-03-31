<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link type="image/x-icon" href="localhost:8000/web/imgs/logo.svg" rel="shortcut icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css" rel="stylesheet">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandImage' => 'imgs/logo.svg',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-site fixed-top',
        ],
    ]); ?>
    <a href="<?= \yii\helpers\Url::home() ?>" class="navbar-brand">Copy Star</a>
    <?php
    $items = [
        ['label' => 'О нас', 'url' => ['/site/index']],
        ['label' => 'Каталог', 'url' => ['/products/catalog']],
        ['label' => 'Где нас найти?', 'url' => ['/site/where']],
        [
            'label' => 'Cart',
            'url' => ['/products/cart'],
            'visible' => !Yii::$app->user->isGuest,
        ],
        [
            'label' => 'Orders',
            'url' => ['/orders/index'],
            'visible' => !Yii::$app->user->isGuest,
        ],
        [
            'label' => 'Admin',
            'items' => [
                ['label' => 'Orders', 'url' => ['/orders/index']],
                ['label' => 'Products', 'url' => ['/products/index']],
                ['label' => 'Categories', 'url' => ['/categories/index']],
            ],
            'visible' => (Yii::$app->user->identity && Yii::$app->user->identity->role === 1),
        ],
        [
            'label' => 'Login',
            'url' => ['/site/login'],
            'visible' => Yii::$app->user->isGuest,
        ],
        [
            'label' => 'Register', 'url' => ['/site/register'],
            'visible' => Yii::$app->user->isGuest,
        ]
    ];

    if (!Yii::$app->user->isGuest) {
        $items[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->login . ')',
                ['class' => 'btn btn-outline-secondary logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>
</header>
<div class="navbar-light"></div>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'] ?? [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer>
    <nav class="flex-column ">
        <div class="flex mt-30">
            <a href="index.html"><img src="../images/logo.svg" alt="" style="padding-right: 10px;"></a>
            <a href="index.html"><p style="font-size: 25px;">ЗАХОДИ.RU</p></a>
        </div>
        <div class="flex menu " style="padding: 20px 0 30px;">
            <a href="events.html" style="padding-left: 20px;">Мероприятия</a>
            <a href="creat-events.html">Организаторам</a>
            <a href="contackt.html">Контакты</a>
        </div>
    </nav>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
