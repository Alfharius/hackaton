<?php

use app\models\Intensive;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\IntensiveSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var \app\models\Thematics[] $thematics */
/** @var \app\models\Users[] $lectors */

$this->title = 'Интенсивы';
?>
<div class="intensive-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', [
        'model' => $searchModel,
        'thematics' => $thematics,
        'lectors' => $lectors
    ]); ?>

    <div class="d-flex f-w-wrap jc-sa">
        <?php
        $intensives = $dataProvider->query->all();
        foreach ($intensives as $intensive) {
            echo \yii\helpers\Html::a('
                <img class="int-img" src="uploads/'.$intensive->img.'" alt="">
                <h4>'.$intensive->name.'</h4>
                <p class="date">дата и время</p>
                <p class="descript">'.$intensive->description.'</p>
                ', ['intensive/view', 'id' => $intensive->id], ['class' => 'intensiv-block']);
        }
        ?>
    </div>


    <?php Pjax::end(); ?>

</div>
