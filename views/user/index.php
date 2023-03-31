<?php

use app\models\Intensive;

/* @var $this yii\web\View */
/* @var $intensives Intensive */

$this->title = 'IntensIF | ' . Yii::$app->user->identity->name;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="users-index">

    <h2>Мои интенсивы</h2>

    <?php if (Yii::$app->user->identity->isAdmin()) echo \yii\helpers\Html::a(\yii\helpers\Html::submitInput('Создать интенсив'))?>

    <div class="d-flex f-w-wrap jc-sa">
        <?php
        foreach ($intensives as $intensive) {
            echo \yii\helpers\Html::a('
                <img src="../imgs/img.png" alt="">
                <h4>'.$intensive->name.'</h4>
                <p class="date">дата и время</p>
                <p class="descript">'.$intensive->description.'</p>
                ', ['intensive/view', 'id' => $intensive->id]);
        } ?>


    </div>

</div>
