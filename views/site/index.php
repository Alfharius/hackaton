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
        <h3>О нашей деятельности</h3>
        <p class="mt-40">Хотите развиваться, но не знаете с чего начать? Приходите и получите реальный опыт, которым мы готовы поделиться вне зависимости от Ваших профессиональных навыков.
            Ждем начинающих специалистов, которым интересно получить знания по следующим направлениям: бэкэнд- или фронтэнд-разработка, машинное обучение, мобильная разработка, функциональное тестирование.
        </p>
    </div>
</section>
<div class="hr"></div>
<section>
    <div class="w-1270 in-center container">
        <h2 style="text-align: center;">Направления обучения</h2>
        <div class="list-napr mt-40">
            <h3>Разработка приложений</h3>
            <p>Имеете опыт работы с одной из промышленных систем управления базами данных: Microsoft SQL Server, PostgrеSQL, Oracle и т.п.; не менее 3 лет программируете на С#,T-SQL, JavaScript, HTML, технологии ASP.NET, NET. Framework, AJAX (владеете одним или сразу несколькими вышеуказанными языками программирования); имеете знания среды разработки Microsoft Visual Studio 2005.</p>
        </div>
        <div class="list-napr mt-40">
            <h3>Бизнес-анализ</h3>
            <p>Имеете опыт работы с одной из промышленных систем управления базами данных: Microsoft SQL Server, PostgrеSQL, Oracle и т.п.; не менее 3 лет программируете на С#,T-SQL, JavaScript, HTML, технологии ASP.NET, NET. Framework, AJAX (владеете одним или сразу несколькими вышеуказанными языками программирования); имеете знания среды разработки Microsoft Visual Studio 2005.</p>
        </div>
        <div class="list-napr mt-40">
            <h3>Информационная безопасность</h3>
            <p>Имеете опыт работы с одной из промышленных систем управления базами данных: Microsoft SQL Server, PostgrеSQL, Oracle и т.п.;</p>
        </div>
    </div>
</section>
<div class="hr"></div>
<section>
    <div class="w-1270 in-center container">
        <h2 style="text-align: center;">Последние новости</h2>
        <?php
        $i = 1;
        foreach ($news as $new) {
            echo
            '<div class="news mt-40">
                '.\yii\helpers\Html::img("uploads/".$new->picture).'
                <h3>'.$new->title.'</h3>
                <p>'.$new->description.'</p>
            </div>';
            if ($i >= 3) break;
            $i++;
        }?>
    </div>
</section>
<div class="hr"></div>

