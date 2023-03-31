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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link type="image/x-icon" href="localhost:8000/web/imgs/logo.svg" rel="shortcut icon">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<header>
<?php $this->beginBody() ?>
    <div class="w-1270 in-center container d-flex jc-sb">
        <div class="logo">
            <?= Html::a(Html::img('imgs/logo.png'), ['/site/index'])?>
        </div>
        <nav>
            <?= Html::a('Главная', ['/site/index'])?>
            <?= Html::a('Интенсивы', ['/site/index'])?>
            <a href="">Планы</a>
        </nav>
        <div class="hamburger-menu ">
            <input id="menu-toggle" type="checkbox" />
            <label class="menu-btn" for="menu-toggle">
                <span></span>
            </label>
            <ul class="menu-box">
                <li><a class="menu-item" href="index.html">Главная</a></li>
                <li><a class="menu-item" href="">Интенсивы</a></li>
                <li><a class="menu-item" href="">Планы</a></li>
            </ul>
        </div>

        <?php if (Yii::$app->user->isGuest) {?>
        <div class="d-flex jc-sb auth-lk">
            <?=Html::a('<input type="button" value="Вход">', ['/site/login'])?>
            <?=Html::a('<input type="button" value="Регистрация">', ['/site/register'])?>
        </div>
        <?php } else {?>
        <div class="d-flex jc-sb lk">
            <?=Html::a('<input type="button" value="'.Yii::$app->user->identity->name.'">', ['/user/index'])?>
            <?php echo Html::a('<input type="submit" value="Выход" data-method="post">', ['/site/logout'], ['data-method' => 'post']) ?>
        </div>
        <?php }?>
    </div>
</header>
<div class="navbar-light"></div>

<section>
    <div class="w-1270 in-center container">
        <?= $content ?>
    </div>
</section>

<footer>
    <div class="w-1270 in-center container">

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
