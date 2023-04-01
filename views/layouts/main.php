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
            <?= Html::a('Интенсивы', ['/intensive/index'])?>
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
                <li><a class="menu-item" href="">Календарь</a></li>
            </ul>
        </div>

        <?php if (Yii::$app->user->isGuest) {?>
        <div class="d-flex jc-sb auth-lk">
            <?=Html::a('<input type="button" value="Вход">', ['/site/login'])?>
            <?=Html::a('<input type="button" value="Регистрация">', ['/site/register'])?>
        </div>
        <?php } else {?>
        <div class="d-flex jc-sb lk">
            <?=Html::a('<input type="button" value="Мои интенсивы">', ['/user/index'])?>
            <?php echo Html::a('<input type="submit" value="Выход">', ['/site/logout'], ['data-method' => 'post']) ?>
        </div>
        <?php }?>
    </div>
</header>
<div class="navbar-light"></div>

<section class="content">
    <div class="w-1270 in-center container">
        <?= $content ?>
    </div>
</section>

<footer class="">
    <h4>Контакты</h4>
    <div class="in-center container f-w-wrap d-flex jc-sb jc-c">
        <div class="w-50">

            <iframe class="d-flex in-center mt-40" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2223.352772769089!2d47.1600731!3d56.133711999999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x415a387aeaf5b781%3A0x5433448da79960b3!2z0KPQvdC40LLQtdGA0YHQuNGC0LXRgtGB0LrQsNGPINGD0LsuLCAzOCwg0KfQtdCx0L7QutGB0LDRgNGLLCDQp9GD0LLQsNGI0YHQutCw0Y8g0KDQtdGB0L8uLCA0MjgwMzQ!5e0!3m2!1sru!2sru!4v1680287752994!5m2!1sru!2sru" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="contacts-cont">
                <div class="contacts">VK</div>
                <div class="contacts">FB</div>
                <div class="contacts">TG</div>
            </div>
        </div>
        <div class="w-50">
            <p>Телефон: <a href="tel:+79003330909">+7 (900) 333-09-09</a></p><br>
            <p>Техническая поддержка: <a href="mailto:support@gmail.com">support@gmail.com</a></p><br>
            <p>Адрес организации:
                <a href="https://www.google.com/maps/place/%D0%A3%D0%BD%D0%B8%D0%B2%D0%B5%D1%80%D1%81%D0%B8%D1%82%D0%B5%D1%82%D1%81%D0%BA%D0%B0%D1%8F+%D1%83%D0%BB.,+38,+%D0%A7%D0%B5%D0%B1%D0%BE%D0%BA%D1%81%D0%B0%D1%80%D1%8B,+%D0%A7%D1%83%D0%B2%D0%B0%D1%88%D1%81%D0%BA%D0%B0%D1%8F+%D0%A0%D0%B5%D1%81%D0%BF.,+428034/@56.133712,47.1600731,17z/data=!4m6!3m5!1s0x415a387aeaf5b781:0x5433448da79960b3!8m2!3d56.133712!4d47.1600731!16s%2Fg%2F11fnvzcbsm"><address>Университетская ул., 38, Чебоксары, Чувашская Респ., 428034</address></a></p><br>
            <p>© 2023 Dark Army</p>
        </div>


    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
