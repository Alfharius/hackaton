<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Где нас найти?';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <h1><?= Html::encode($this->title) ?></h1>
    <b>Адрес:</b> ул. Социалистической революции, д. 17 <br>
    <b>Телефон:</b> 71822041870 <br>
    <b>email:</b> schizoidgada@yandex.com <br>
    <?= yii\bootstrap4\Accordion::widget([
        'items' => [
            'Карта' => (\yii\bootstrap4\Html::img('imgs/map.png', ['width' => '100%'])),
        ],
        'options' => ['class' => 'mt-3']
    ]) ?>
</div>