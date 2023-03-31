<?php

/** @var yii\web\View $this */

/** @var News $news */

use app\models\News;
use yii\bootstrap4\Carousel;

$this->title = 'Intensif';
?>

<section class="d-flex jc-sb w-100 container f-w-wrap">
    <div class="w-80">
        <h2 class="mt-180">Если вам нужно сделать </h2>
        <h3>шаг навстречу мечтам!</h3>
        <p class="mt-40">Intensive Finder - поиск наикрутейших интенсивов.</p>
        <p class="mb-120">ЕСЛИ хотите прокачать свой скилл, присоединяйтесь</p>
    </div>
    <div class="w-20 jc-c">
        <img src="imgs/krosh.png" alt="Крош" width="300" class="krosh">
    </div>
</section>


<div class="hr"></div>
<section>
    <div class="w-1270 in-center container">
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laborum harum molestias, voluptates dolor quasi ratione quidem iste dolore reiciendis iure, dolores commodi. Enim minima velit dolorum mollitia molestias nostrum amet!</p>
    </div>

</section>
<div class="hr"></div>


<section>
    <div class="w-1270 in-center">
        <h2 style="text-align: center;">Фильтр</h2>
        <form action="">
            <div>
                <label for="name">Название интенсива</label><br>
                <input type="text" name="name">
            </div>
            <div>
                <label>Название тематики</label><br>
                <input type="checkbox" name="1"><label>Бизнес-анализ</label><br>
                <input type="checkbox" name="2"><label>Программирование</label><br>
                <input type="checkbox" name="3"><label>Информационная безопасность</label><br>
                <input type="checkbox" name="4"><label>Тестирование</label><br>
                <input type="checkbox" name="5"><label>Web-design</label><br>
            </div>
            <div class="mt-40">
                <label for="lector" >Лектор</label><br>
                <select name="lector">
                    <option value="1">Александров Виталя</option>
                    <option value="2">Ефимов Александр</option>
                    <option value="3">Казанцев Николай</option>
                    <option value="4">Родионова Виктория</option>
                </select>
            </div>

            <input type="submit" value="Найти">
        </form>
    </div>
</section>
<section>
    <div class="w-1270 in-center container mt-180">
        <h1>Интенсивы</h1>
        <div class="d-flex f-w-wrap jc-sa">

            <a href="info-intensiv.html" class="intensiv-block">
                <img src="/images/img.png" alt="">
                <p class="date">дата и время</p>
                <h5>Заг1</h5>
                <p class="descript">Description</p>
            </a>


        </div>
    </div>
</section>

<div class="hr"></div>
