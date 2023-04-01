<?php

use app\models\Intensive;

/* @var $this yii\web\View */
/* @var $intensives Intensive */

$this->title = 'IntensIF | ' . Yii::$app->user->identity->name;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="users-index">

    <h2>Мои интенсивы</h2>

    <?php if (Yii::$app->user->identity->isAdmin()) echo \yii\helpers\Html::a(\yii\helpers\Html::submitInput('Создать интенсив'), ['/intensive/create'])?>

    <div class="d-flex f-w-wrap jc-sa">
        <?php
        if (count($intensives) == 0) echo '<div class="mt-180">Здесь пока ничего нет. Запишитесь на интенсив)</div>';
        foreach ($intensives as $intensive) {
            echo \yii\helpers\Html::a('
                <img src="uploads/'.$intensive->img.'" alt="">
                <h4>'.$intensive->name.'</h4>
                <p class="date">дата и время</p>
                <p class="descript">'.$intensive->description.'</p>
                ', ['intensive/view', 'id' => $intensive->id]);
        } ?>


    </div>

</div>
